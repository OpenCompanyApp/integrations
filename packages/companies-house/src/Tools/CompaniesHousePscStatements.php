<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * List PSC statements for a company.
 */
class CompaniesHousePscStatements extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_psc_statements';
    protected const DESCRIPTION = 'List persons-with-significant-control statements for a company.';
    protected const METHOD = 'pscStatements';
    protected const REQUIRED = ['company_number'];
    protected const QUERY_KEYS = ['items_per_page', 'start_index'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
        'items_per_page' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
        'start_index' => ['type' => 'integer', 'required' => false, 'description' => 'Pagination offset.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official query parameters.'],
    ];
}
