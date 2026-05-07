<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Retrieve company insolvency information.
 */
class CompaniesHouseInsolvency extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_insolvency';
    protected const DESCRIPTION = 'Retrieve insolvency cases and practitioners for a company.';
    protected const METHOD = 'insolvency';
    protected const REQUIRED = ['company_number'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
    ];
}
