<?php



use App\Models\Company;
use App\Models\Employee;

// check if company exist with @param name

if (!function_exists('companyExist')) {
        function companyExist($company_name)
        {
                $company = Company::where('company_name', $company_name)->first();
                return $company;
        
        }
}

// check if company id exist with @param id

if (!function_exists('companyIdExist')) {
        function companyIdExist($id)
        {
                $company = Company::where('id', $id)->first();
                return $company;
        }
}

// check if company dosen't has any employ exist with @param id

if (!function_exists('companyHaseNoEmploy')) {
        function companyHaseNoEmploy($id)
        {
                $company = Company::join('employees', 'companies.id', '=', 'employees.companies_id')
                           ->where('companies.id',  $id)->first();
                return $company;
        }
}

// check if email already invited

if (!function_exists('emailExist')) {
        function emailExist($email)
        {
                $employe = Employee::where('email', $email)->first();
                return $employe;
        }
}
