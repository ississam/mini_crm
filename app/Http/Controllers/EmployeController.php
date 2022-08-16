<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeController extends Controller
{

    const _RESPONSE_EMAIL_ALREADY_EXIST_CODE = 409;
    const _RESPONSE_EMAIL_ALREADY_EXIST_MESSAGE = 'Email already exist';

    const _RESPONSE_EMAIL_NOT_VALID_CODE = 409;
    const _RESPONSE_EMAIL_NOT_VALID_MESSAGE = 'Email not valid';

    const _RESPONSE_EMAIL_SENT_CODE = '000';
    const _RESPONSE_EMAIL_SENT_MESSAGE = 'Invitation sent to employe';
    /**
     * Invite an employe.
     *

     */
    public function inviteEmploye(Request $request)
    {
        //check email is valid

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            $response = response()->json([
                'response_code' => self::_RESPONSE_EMAIL_NOT_VALID_CODE,
                'response_message' => self::_RESPONSE_EMAIL_NOT_VALID_MESSAGE,
            ]);
        }
        
        //if email already exist in DB
        $employe_email = emailExist($request->email);

        if ($employe_email)
        {
            $response = response()->json([
                'response_code' => self::_RESPONSE_EMAIL_ALREADY_EXIST_CODE,
                'response_message' => self::_RESPONSE_EMAIL_ALREADY_EXIST_MESSAGE,
            ]);

            return $response;
        }

    return "send email";


    }
}
