<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * List charges for a company.
 */
class CompaniesHouseCharges extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_charges';
    protected const DESCRIPTION = 'List mortgage and charge records for a company.';
    protected const METHOD = 'charges';
    protected const REQUIRED = ['company_number'];
    protected const QUERY_KEYS = ['items_per_page', 'start_index'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
        'items_per_page' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
        'start_index' => ['type' => 'integer', 'required' => false, 'description' => 'Pagination offset.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official query parameters.'],
    ];
}
