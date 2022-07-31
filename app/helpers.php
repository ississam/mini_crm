<?php

// check if company exist with @param name

use App\Models\Company;

if (!function_exists('companyExist')) {
        function companyExist($company_name)
        {
                $company = Company::where('company_name', $company_name)->first();
                return $company;
        
        }
}
        