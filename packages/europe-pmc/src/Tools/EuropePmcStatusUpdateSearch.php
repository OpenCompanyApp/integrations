<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * Search Europe PMC article status updates.
 */
class EuropePmcStatusUpdateSearch extends AbstractEuropePmcTool
{
    protected const NAME = 'europe_pmc_status_update_search';
    protected const DESCRIPTION = 'Search Europe PMC article status updates with the status-update-search endpoint.';
    protected const METHOD = 'POST';
    protected const PATH = 'status-update-search';
    protected const DEFAULTS = ['format' => 'json'];
    protected const REQUIRED = ['query'];
    protected const PARAMETERS = [
        'query' => ['type' => 'string', 'required' => true, 'description' => 'Status update query.'],
        'pageSize' => ['type' => 'integer', 'required' => false, 'description' => 'Results per page.'],
        'cursorMark' => ['type' => 'string', 'required' => false, 'description' => 'Cursor mark for paging.'],
    ];
}
