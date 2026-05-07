<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * update account_capability.
 *
 * Maps to the official Modern Treasury endpoint patch /api/internal_accounts/{internal_account_id}/account_capabilities/{id}.
 */
class ModernTreasuryUpdateAccountCapability extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_update_account_capability';
    protected const DESCRIPTION = 'update account_capability

Official Modern Treasury endpoint: PATCH /api/internal_accounts/{internal_account_id}/account_capabilities/{id}';
    protected const PARAMETERS = array (
  'internal_account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `internal_account_id` from the official Modern Treasury API operation.',
  ),
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
    protected const PATH = '/api/internal_accounts/{internal_account_id}/account_capabilities/{id}';
    protected const PATH_PARAMS = array (
  'internal_account_id' => 'internal_account_id',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
