<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Retrieve a company registered office address.
 */
class CompaniesHouseRegisteredOfficeAddress extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_registered_office_address';
    protected const DESCRIPTION = 'Retrieve the registered office address for a company.';
    protected const METHOD = 'registeredOfficeAddress';
    protected const REQUIRED = ['company_number'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
    ];
}
