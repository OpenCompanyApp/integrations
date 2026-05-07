<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Retrieve company registers.
 */
class CompaniesHouseRegisters extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_registers';
    protected const DESCRIPTION = 'Retrieve company register information.';
    protected const METHOD = 'registers';
    protected const REQUIRED = ['company_number'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
    ];
}
