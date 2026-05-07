<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * List persons with significant control for a company.
 */
class CompaniesHousePscList extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_psc_list';
    protected const DESCRIPTION = 'List persons with significant control for a company.';
    protected const METHOD = 'pscList';
    protected const REQUIRED = ['company_number'];
    protected const QUERY_KEYS = ['items_per_page', 'start_index', 'register_view'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
        'items_per_page' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
        'start_index' => ['type' => 'integer', 'required' => false, 'description' => 'Pagination offset.'],
        'register_view' => ['type' => 'boolean', 'required' => false, 'description' => 'Return register view when supported.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official query parameters.'],
    ];
}
