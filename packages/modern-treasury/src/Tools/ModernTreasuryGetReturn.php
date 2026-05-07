<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * show return.
 *
 * Maps to the official Modern Treasury endpoint get /api/returns/{id}.
 */
class ModernTreasuryGetReturn extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_return';
    protected const DESCRIPTION = 'show return

Official Modern Treasury endpoint: GET /api/returns/{id}

Get a single return.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/returns/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
