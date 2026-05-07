<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Search Companies House companies by name or number.
 */
class CompaniesHouseSearchCompanies extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_search_companies';
    protected const DESCRIPTION = 'Search UK companies by name or company number.';
    protected const METHOD = 'searchCompanies';
    protected const REQUIRED = ['q'];
    protected const QUERY_KEYS = ['q', 'items_per_page', 'start_index'];
    protected const PARAMETERS = [
        'q' => ['type' => 'string', 'required' => true, 'description' => 'Company name, previous name, or number query.'],
        'items_per_page' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
        'start_index' => ['type' => 'integer', 'required' => false, 'description' => 'Pagination offset.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official query parameters.'],
    ];
}
