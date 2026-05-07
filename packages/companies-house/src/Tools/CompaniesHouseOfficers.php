<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * List officers for a company.
 */
class CompaniesHouseOfficers extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_officers';
    protected const DESCRIPTION = 'List current and historical officers for a company.';
    protected const METHOD = 'officers';
    protected const REQUIRED = ['company_number'];
    protected const QUERY_KEYS = ['items_per_page', 'start_index', 'order_by', 'register_type'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
        'items_per_page' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
        'start_index' => ['type' => 'integer', 'required' => false, 'description' => 'Pagination offset.'],
        'order_by' => ['type' => 'string', 'required' => false, 'description' => 'Official officer ordering parameter.'],
        'register_type' => ['type' => 'string', 'required' => false, 'description' => 'Optional register type filter.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official query parameters.'],
    ];
}
