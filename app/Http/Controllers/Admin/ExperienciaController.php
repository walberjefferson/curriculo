<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExperienciaController extends Controller
{
    public function index()
    {
        return view('');
    }

    public function create()
    {
        return view('');
    }

    public function store(Request $request)
    {
        try {
            \DB::beginTransaction();
            \DB::commit();
            return $request->all();
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('message-danger', '');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            \DB::beginTransaction();
            \DB::commit();
            return $request->all();
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('message-danger', '');
        }
    }

    public function destroy($uuid)
    {
        try {
            \DB::beginTransaction();
            \DB::commit();
            return $uuid;
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('message-danger', '');
        }
    }
}
