<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get bulk_result.
 *
 * Maps to the official Modern Treasury endpoint get /api/bulk_results/{id}.
 */
class ModernTreasuryGetBulkResult extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_bulk_result';
    protected const DESCRIPTION = 'get bulk_result

Official Modern Treasury endpoint: GET /api/bulk_results/{id}';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/bulk_results/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
