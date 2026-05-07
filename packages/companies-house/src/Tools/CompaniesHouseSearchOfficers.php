<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Search Companies House officers.
 */
class CompaniesHouseSearchOfficers extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_search_officers';
    protected const DESCRIPTION = 'Search company officers by name.';
    protected const METHOD = 'searchOfficers';
    protected const REQUIRED = ['q'];
    protected const QUERY_KEYS = ['q', 'items_per_page', 'start_index'];
    protected const PARAMETERS = [
        'q' => ['type' => 'string', 'required' => true, 'description' => 'Officer name query.'],
        'items_per_page' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
        'start_index' => ['type' => 'integer', 'required' => false, 'description' => 'Pagination offset.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official query parameters.'],
    ];
}
