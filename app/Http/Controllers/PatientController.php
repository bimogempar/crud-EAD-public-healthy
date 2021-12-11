<?php

namespace App\Http\Controllers;

use App\Models\patient;
use App\Models\vaccine;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $vaccines = vaccine::get();
        $patients = patient::get();

        return view('patient', compact('vaccines', 'patients'));
    }

    public function store(vaccine $vaccine)
    {
        $attr = request()->validate([
            'name' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        $attr['vaccine_id'] = $vaccine->id;
        patient::create($attr);
        return redirect()->back()->with('success', 'Success register patient.');
    }

    public function update(patient $patient)
    {
        $attr = request()->validate([
            'name' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        $patient->update($attr);
        return redirect()->back()->with('success', 'Success update patient.');
    }

    public function destroy(patient $patient)
    {
        $patient->delete();
        return redirect()->back()->with('success', 'Success delete patient.');
    }
}
