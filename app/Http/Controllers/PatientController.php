<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PatientRecord;
use App\http\Requests\PatientRequest;
use Illuminate\Support\Facades\Auth;
use function compact;
use function redirect;
use function view;

class PatientController extends Controller
{
    public function patientrecord(){ 
        $user = Auth::user();
        $userlist = [];
        $records = PatientRecord::all();
        return view('Patientrecord', compact('records','user','userlist'));
        }



        public function createpatients(Request $input){
            $input->validate([
                'patient_name' => ['required', 'string', 'max:255'],
                'patient_condition' => ['string', 'max:100'],
                'patient_ward' => ['string', 'max:400'],
                'doctor_assigned' => ['string', 'max:100'],
                // 'added_by' => ['required'],
            ]);
        
            $record_created = PatientRecord::create([
                'patient_name' => $input['patient_name'],
                'patient_condition' => $input['patient_condition'],
                'patient_ward' => $input['patient_ward'],
                'doctor_assigned' => $input['doctor_assigned'],
                // 'added_by' => $input['added_by'],
            ]);
            // dd($record_created);
            if (!$record_created) {
                return redirect()->back()->withErrors(['error' => 'an error occurred : record cannot be created']);
            }
            return redirect('/Patientrecord')->withErrors(['status' => 'patient record successfully']);
        }

        public function patientupdate(PatientRequest $request,$id){

            $patient = PatientRecord::find($id);

            $input = $request->all();

            $patient->fill($input)->save();
        //   dd($patient);
            return redirect('/Patientrecord')->withErrors(['status'=>'records updated!']);
        }

public function deleterecord(Request $request,$id){

    $records = PatientRecord::find($id);
    $records->delete();
// dd($records);
    return redirect('/Patientrecord')->withErrors(['status'=>'records deleted!']);
}

}
