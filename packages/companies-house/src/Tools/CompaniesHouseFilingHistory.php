<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * List filing history for a company.
 */
class CompaniesHouseFilingHistory extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_filing_history';
    protected const DESCRIPTION = 'List filing history items for a company.';
    protected const METHOD = 'filingHistory';
    protected const REQUIRED = ['company_number'];
    protected const QUERY_KEYS = ['category', 'items_per_page', 'start_index'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
        'category' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Filing category or categories.'],
        'items_per_page' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
        'start_index' => ['type' => 'integer', 'required' => false, 'description' => 'Pagination offset.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official query parameters.'],
    ];
}
