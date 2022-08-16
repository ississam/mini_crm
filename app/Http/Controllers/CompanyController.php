<?php

namespace App\Http\Controllers;
use App\Http\Requests\CheckCompanyData;
use Illuminate\Http\Request;
use App\Models\company;

class companyController extends Controller
{

    const _RESPONSE_COMPANY_NAME_EXIST_CODE = 409;
    const _RESPONSE_COMPANY_NAME_EXIST_MESSAGE = 'Company name already exist';

    const _RESPONSE_COMPANY_CAN_NOT_DELETED_CODE = 409;
    const _RESPONSE_COMPANY_CAN_NOT_DELETED_MESSAGE = 'Can not delete company, it has some employes';

    const _RESPONSE_COMPANY_ID_NOT_EXIST_CODE = 404;
    const _RESPONSE_COMPANY_ID_NOT_EXIST_MESSAGE = 'Company Id not exist';

    const _RESPONSE_COMPANY_CREATED_CODE = '000';
    const _RESPONSE_COMPANY_CREATED_MESSAGE = 'Company created';
    
    const _RESPONSE_COMPANY_UPDATED_CODE = '000';
    const _RESPONSE_COMPANY_UPDATED_MESSAGE = 'Company Updated';

    const _RESPONSE_COMPANY_DELETED_CODE = '000';
    const _RESPONSE_COMPANY_DELETED_MESSAGE = 'Company Deleted';
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies_list = company::get();

        return response()->json($companies_list, 200);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CheckCompanyData $request)
    {

      $company_data = companyExist($request->company_name);

        //check merchant name sent in request exist in DB

        if ($company_data) {

            $response = response()->json([
                'response_code' => self::_RESPONSE_COMPANY_NAME_EXIST_CODE,
                'response_message' => self::_RESPONSE_COMPANY_NAME_EXIST_MESSAGE,
            ]);

            return $response;
        }

        Company::create([
            'company_name' => $request->company_name
        ]);

        return response()->json([
            'response_code' => self::_RESPONSE_COMPANY_CREATED_CODE,
            'response_message' => self::_RESPONSE_COMPANY_CREATED_MESSAGE,
        ]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckCompanyData $request, $id)
    {
       $company_to_find = Company::find($id);

       $company_data = companyExist($request->company_name);

        //check company name sent in request exist in DB
        if($company_data)
        {
            if ($company_data->company_name == $request->company_name && $company_data->id != $id ) {

                $response = response()->json([
                    'response_code' => self::_RESPONSE_COMPANY_NAME_EXIST_CODE,
                    'response_message' => self::_RESPONSE_COMPANY_NAME_EXIST_MESSAGE,
                ]);

                return $response;
            }
        }
        
        // update company data 
        $company_to_find->company_name = $request->company_name;
        $company_to_find->save();

        return response()->json([
            'response_code' => self::_RESPONSE_COMPANY_UPDATED_CODE,
            'response_message' => self::_RESPONSE_COMPANY_UPDATED_MESSAGE,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

        //check if company already exist in DB
        $company_data = companyIdExist($request->id);
       
        if(!$company_data)
        {

                $response = response()->json([
                    'response_code' => self::_RESPONSE_COMPANY_ID_NOT_EXIST_CODE,
                    'response_message' => self::_RESPONSE_COMPANY_ID_NOT_EXIST_MESSAGE,
                ]);

                return $response;

        }
        //check company id sent in request exist in DB
        $data = companyHaseNoEmploy($request->id);

        if (!$data) 
        {
            //delete company
            $company_to_find = Company::find($id);
            $company_to_find->delete();

            return response()->json([
                'response_code' => self::_RESPONSE_COMPANY_DELETED_CODE,
                'response_message' => self::_RESPONSE_COMPANY_DELETED_MESSAGE,
            ]);
            
        }

        return response()->json([
            'response_code' => self::_RESPONSE_COMPANY_CAN_NOT_DELETED_CODE,
            'response_message' => self::_RESPONSE_COMPANY_CAN_NOT_DELETED_MESSAGE,
        ]);



       
    }

    public function auth(Request $request)
    {
        dd('ddd');
    }
}
