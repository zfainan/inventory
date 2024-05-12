<?php

namespace App\Http\Controllers;

use App\Constants\JabatanEnum;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::with(['petugas'])->latest()->paginate();
        $jabatan = JabatanEnum::cases();

        return view('user.index', [
            'data' => $data,
            'jabatan' => $jabatan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'jabatan' => ['required', Rule::enum(JabatanEnum::class)],
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        try {
            DB::beginTransaction();

            $petugas = Petugas::create([
                'nama_petugas' => $request->name,
                'jabatan' => $request->jabatan,
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_petugas' => $petugas->id,
            ]);

            DB::commit();

            return redirect(route('users.index'))->with('status', 'Berhasil menambah user!');
        } catch (\Throwable $th) {
            DB::rollback();

            return redirect()->back()->with('status', 'Gagal menambah user! '.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            $user->petugas->delete();

            return redirect(route('users.index'))->with('status', 'Berhasil hapus akun!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Gagal simpan data! '.$th->getMessage());
        }
    }
}
