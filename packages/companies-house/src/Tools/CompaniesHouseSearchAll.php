<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Search Companies House companies, officers, and disqualified officers.
 */
class CompaniesHouseSearchAll extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_search_all';
    protected const DESCRIPTION = 'Search Companies House across companies, officers, and disqualified officers.';
    protected const METHOD = 'searchAll';
    protected const REQUIRED = ['q'];
    protected const QUERY_KEYS = ['q', 'items_per_page', 'start_index'];
    protected const PARAMETERS = [
        'q' => ['type' => 'string', 'required' => true, 'description' => 'Search query.'],
        'items_per_page' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
        'start_index' => ['type' => 'integer', 'required' => false, 'description' => 'Pagination offset.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official query parameters.'],
    ];
}
