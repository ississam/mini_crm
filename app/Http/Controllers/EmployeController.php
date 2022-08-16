<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckEmployeeData;
use App\Models\Employee;
use App\Models\History;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;

class EmployeController extends Controller
{

    const _RESPONSE_EMAIL_ALREADY_EXIST_CODE = 409;
    const _RESPONSE_EMAIL_ALREADY_EXIST_MESSAGE = 'Email already exist';

    const _RESPONSE_EMAIL_NOT_VALID_CODE = 409;
    const _RESPONSE_EMAIL_NOT_VALID_MESSAGE = 'Email not valid';

    const _RESPONSE_DATA_NOT_VALID_CODE = 409;

    const _RESPONSE_EMAIL_SENT_CODE = '000';
    const _RESPONSE_EMAIL_SENT_MESSAGE = 'Invitation sent to employe';

    const _RESPONSE_EMPLOYEE_PROFILE_EDITED_CODE = '000';
    const _RESPONSE_EMPLOYEE_PROFILE_EDITED_MESSAGE = 'Profile edited';

    /**
     * Invite an employe.
     *
     * @return \Illuminate\Http\Response
     */
    public function inviteEmploye(Request $request)
    {
        //check email is valid

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:employees',
            'name' => 'required'
        ]);

        
        if ($validator->fails()) 
        {
             
            // dd($validator);
            $response = response()->json([
                'response_code' => self::_RESPONSE_DATA_NOT_VALID_CODE,
                'response_message' =>$validator->errors()->first(),
            ]);

            return $response;
        }
        
        //if email already exist in DB
        $employe_email = emailExist($request->email);
       
        //send email if no email in DB
        if ($employe_email)
        {
            $response = response()->json([
                'response_code' => self::_RESPONSE_EMAIL_ALREADY_EXIST_CODE,
                'response_message' => self::_RESPONSE_EMAIL_ALREADY_EXIST_MESSAGE,
            ]);

            // $data = array('name' => "Virat Gandhi");
            $data = [
                'name' => "Virat Gandhi",
            ];

            // Mail::send(['text' => 'InvitationEmail'], $data, function ($message)  {
            //     $message->to('issam_elyazri@yahoo.fr')->subject('sub')->from('aa@df.com', 'Virat Gandhi');
            // });
            $data = [];
            Mail::send('welcome', $data, function ($message) {
                $message->to('issam_elyazri@yahoo.fr', 'John Doe')->subject('Welcome!');
            });
        }

        $mail_to_add = $request->email;

        $created_employee_data= Employee::create([
            'email' => $request->email,
            'name' => $request->name,
            'type' => Employee::_EMPLOYEE_USER,
        ]);

        $created_invitation_data = Invitation::create([
            'employees_id' => $created_employee_data->id,
            'status' => Invitation::_SENT_INVITATION,
        ]);

        History::create([
            'invitations_id' => $created_invitation_data->id,
            'date_history' => date('Y-m-d H:i:s'),
        ]);

        $response = response()->json([
            'response_code' => self::_RESPONSE_EMAIL_SENT_CODE,
            'response_message' => self::_RESPONSE_EMAIL_SENT_MESSAGE,
        ]);

        return $response;


    }


    /**
     * Invite an employe.
     *
     * @return \Illuminate\Http\Response
     */
    public function completeEmployeeProfile(CheckEmployeeData $request,  $id)
    {

        $employee_to_edit_profile = Employee::find($id);
        $employee_to_edit_profile->password = $request->password;
        $employee_to_edit_profile->adress = $request->adress;
        $employee_to_edit_profile->tel = $request->tel;
        $employee_to_edit_profile->born_date = $request->born_date;
        $employee_to_edit_profile->save();

        $response = response()->json([
            'response_code' => self::_RESPONSE_EMPLOYEE_PROFILE_EDITED_CODE,
            'response_message' => self::_RESPONSE_EMPLOYEE_PROFILE_EDITED_MESSAGE,
        ]);

        return $response;

    }
}
