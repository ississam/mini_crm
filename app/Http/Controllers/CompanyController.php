<?php

namespace App\Http\Controllers;
use App\Http\Requests\CheckCompanyData;
use Illuminate\Http\Request;
use App\Models\company;

class companyController extends Controller
{

    const _RESPONSE_COMPANY_NAME_EXIST_CODE = 409;
    const _RESPONSE_COMPANY_NAME_EXIST_MESSAGE = 'Company name already exist';
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
