<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Search companies using the official advanced company search filters.
 */
class CompaniesHouseAdvancedSearchCompanies extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_advanced_search_companies';
    protected const DESCRIPTION = 'Search companies with advanced filters such as status, type, SIC code, incorporation date, and location.';
    protected const METHOD = 'advancedSearchCompanies';
    protected const QUERY_KEYS = ['company_name_includes', 'company_name_excludes', 'company_status', 'company_type', 'sic_codes', 'incorporated_from', 'incorporated_to', 'location', 'dissolved_from', 'dissolved_to', 'items_per_page', 'start_index'];
    protected const PARAMETERS = [
        'company_name_includes' => ['type' => 'string', 'required' => false, 'description' => 'Words the company name should include.'],
        'company_name_excludes' => ['type' => 'string', 'required' => false, 'description' => 'Words the company name should exclude.'],
        'company_status' => ['type' => 'string', 'required' => false, 'description' => 'Company status filter such as active or dissolved.'],
        'company_type' => ['type' => 'string', 'required' => false, 'description' => 'Company type filter.'],
        'sic_codes' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'SIC code or comma-joined/list of SIC codes.'],
        'incorporated_from' => ['type' => 'string', 'required' => false, 'description' => 'Earliest incorporation date, YYYY-MM-DD.'],
        'incorporated_to' => ['type' => 'string', 'required' => false, 'description' => 'Latest incorporation date, YYYY-MM-DD.'],
        'location' => ['type' => 'string', 'required' => false, 'description' => 'Location text filter.'],
        'items_per_page' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
        'start_index' => ['type' => 'integer', 'required' => false, 'description' => 'Pagination offset.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official advanced search parameters.'],
    ];
}
