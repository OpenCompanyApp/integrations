<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Retrieve a single PSC statement.
 */
class CompaniesHousePscStatement extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_psc_statement';
    protected const DESCRIPTION = 'Retrieve one person-with-significant-control statement.';
    protected const METHOD = 'pscStatement';
    protected const REQUIRED = ['company_number', 'statement_id'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
        'statement_id' => ['type' => 'string', 'required' => true, 'description' => 'PSC statement identifier from list links.'],
    ];
}
