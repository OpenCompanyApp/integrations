<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get bulk_request.
 *
 * Maps to the official Modern Treasury endpoint get /api/bulk_requests/{id}.
 */
class ModernTreasuryGetBulkRequest extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_bulk_request';
    protected const DESCRIPTION = 'get bulk_request

Official Modern Treasury endpoint: GET /api/bulk_requests/{id}';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/bulk_requests/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
