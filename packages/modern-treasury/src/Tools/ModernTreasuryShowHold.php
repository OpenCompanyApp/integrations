<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * show hold.
 *
 * Maps to the official Modern Treasury endpoint get /api/holds/{id}.
 */
class ModernTreasuryShowHold extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_show_hold';
    protected const DESCRIPTION = 'show hold

Official Modern Treasury endpoint: GET /api/holds/{id}

Get a specific hold';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/holds/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
