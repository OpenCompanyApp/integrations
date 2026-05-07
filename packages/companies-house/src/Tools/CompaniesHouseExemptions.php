<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Retrieve company disclosure exemptions.
 */
class CompaniesHouseExemptions extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_exemptions';
    protected const DESCRIPTION = 'Retrieve company disclosure exemptions.';
    protected const METHOD = 'exemptions';
    protected const REQUIRED = ['company_number'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
    ];
}
