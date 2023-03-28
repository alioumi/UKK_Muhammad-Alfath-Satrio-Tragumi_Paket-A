<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {

        return view('user.landing');
    }

    public function formLogin()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {

        $username = Masyarakat::where('username', $request->username)->first();

        // Pengecekan variable $username jika password tidak sama dengan yang dikirimkan
        if (!$username) {
            return redirect()->back()->with(['pesan' => 'Username tidak terdaftar']);
        }

        // check password yang dikirim di form dan di table, hasilnya sama atau tidak
        $password = Hash::check($request->password, $username->password);

        // Pengecekan variable $password jika password tidak sama dengan yang dikirimkan
        if (!$password) {
            return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
        }

        // Jalankan fungsi auth jika berjasil melewati validasi di atas
        if (Auth::guard('masyarakat')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->intended('/laporan/me')->with(['berhasil' => 'Berhasil Login!']);                 // Jika login berhasil
        } else {
            return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']); // Jika login gagal
        }
    }

    public function formRegister()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nik' => ['required'],
            'nama' => ['required'],
            'username' => ['required'],
            'password' => ['required'],
            'telp' => ['required'],
            'jenis_kelamin' => ['required'],
            'alamat' => ['required'],
        ]);

        // return redirect()->back()
        // ->with('success', 'Created successfully!');
        // } catch (\Exception $e){
        //     return redirect()->back()
        //     ->with('error', 'Error during the creation!');
        // }

        if ($validate->fails()) {
            return redirect()->back()->with(['pesan' => $validate->errors()]);
        }

        $username = Masyarakat::where('username', $request->username)->first();

        if ($username) {
            return redirect()->back()->with(['pesan' => 'Username sudah terdaftar']);
        }

        Masyarakat::create([
            'nik' => $data['nik'],
            'nama' => $data['nama'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'jenis_kelamin' =>$data['jenis_kelamin'],
            'alamat' =>$data['alamat'],
            'telp' => $data['telp'],
        ]);

        // return redirect()->back()
        // ->with('success', 'Created successfully!');
        // } catch (\Exception $e){
        //     return redirect()->back()
        //     ->with('error', 'Error during the creation!');
        // }

        return redirect()->route('laporma.formLogin')->with(['Berhasil terkirim!', 'type' => 'success']);
        // return redirect()->route('laporma.index');
    }

    public function logout()
    {
        Auth::guard('masyarakat')->logout();

        return redirect()->back();
    }

    public function storePengaduan(Request $request)
    {
        if (!Auth::guard('masyarakat')->user()) {
            return redirect()->back()->with(['pesan' => 'Login dibutuhkan!'])->withInput();
        }
        //kalau belum login arahin login dulu dengan pesan

        $data = $request->all();

        $validate = Validator::make($data, [
            'isi_laporan' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('assets/pengaduan', 'public');
        }

        date_default_timezone_set('Asia/Bangkok');

        $pengaduan = Pengaduan::create([
            'tgl_pengaduan' => date('Y-m-d h:i:s'),
            'nik' => Auth::guard('masyarakat')->user()->nik,
            'isi_laporan' => $data['isi_laporan'],
            'foto' => $data['foto'] ?? '', //jika null maka masukan string kosong
            'status' => '0', //default 0
        ]); //mengirimkan data ke table

        if ($pengaduan) {
            return redirect()->route('laporma.laporan', 'me')->with(['pengaduan' => 'Berhasil terkirim!', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['pengaduan' => 'Gagal terkirim!', 'type' => 'danger']);
        }
    }

    public function private($id_tanggapan)
    {
        Tanggapan::where('id_tanggapan', '$id_tanggapan')->update(['akses'=>'private']);
        return redirect()->back();
    }

    public function public($id_tanggapan)
    {
        Tanggapan::where('id_tanggapan', '$id_tanggapan')->update(['akses'=>'public']);
        return redirect()->back();
    }

    public function laporan($siapa = '')
    {
        $terverifikasi = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', '!=', '0']])->get()->count();
        $proses = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', 'Proses']])->get()->count();
        $selesai = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', 'selesai']])->get()->count();

        $hitung = [$terverifikasi, $proses, $selesai];

        if ($siapa == 'me') {
            $pengaduan = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->orderBy('tgl_pengaduan', 'desc')->with('user', 'tanggapan')->get();
            return view('user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa]);
        } else {
            $pengaduan = Pengaduan::where([['nik', '!=', Auth::guard('masyarakat')->user()->nik], ['status', '!=', '0'], ])->orderBy('tgl_pengaduan', 'desc')->get();
            return view('user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa]);
        }
    }

    public function construct()
    {
        $this->middleware(function($request,$next){
            if (session('success')) {
                Alert::success(session('success'));
            }

            if (session('error')) {
                Alert::error(session('error'));
            }

            return $next($request);
        });
    }
}
