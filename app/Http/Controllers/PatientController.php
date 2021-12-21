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

        dd($attr['no_hp'] = request('no_hp'));

        $attr['vaccine_id'] = $vaccine->id;
        if (request()->file('image_ktp')) {
            $attr['image_ktp'] = request()->file('image_ktp')->store('img-ktp-patient');
        }
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

        if (request()->file('image_ktp')) {
            \Storage::delete($patient->image_ktp);
            $updateimg = request()->file('image_ktp')->store('img-ktp-patient');
        } else {
            $updateimg = $patient->image_ktp;
        }

        $attr['image_ktp'] = $updateimg;
        $patient->update($attr);
        return redirect()->back()->with('success', 'Success update patient.');
    }

    public function destroy(patient $patient)
    {
        \Storage::delete($patient->image_ktp);
        $patient->delete();
        return redirect()->back()->with('success', 'Success delete patient.');
    }
}
