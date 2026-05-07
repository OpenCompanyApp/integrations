<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * update hold.
 *
 * Maps to the official Modern Treasury endpoint patch /api/holds/{id}.
 */
class ModernTreasuryUpdateHold extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_update_hold';
    protected const DESCRIPTION = 'update hold

Official Modern Treasury endpoint: PATCH /api/holds/{id}

Update a hold';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Modern Treasury OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
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
