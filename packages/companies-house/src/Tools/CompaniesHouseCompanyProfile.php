<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Retrieve a Companies House company profile.
 */
class CompaniesHouseCompanyProfile extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_company_profile';
    protected const DESCRIPTION = 'Retrieve official company profile data by company number.';
    protected const METHOD = 'companyProfile';
    protected const REQUIRED = ['company_number'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
    ];
}
