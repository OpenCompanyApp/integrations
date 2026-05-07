<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * update internal account.
 *
 * Maps to the official Modern Treasury endpoint patch /api/internal_accounts/{id}.
 */
class ModernTreasuryUpdateInternalAccount extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_update_internal_account';
    protected const DESCRIPTION = 'update internal account

Official Modern Treasury endpoint: PATCH /api/internal_accounts/{id}';
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
    protected const PATH = '/api/internal_accounts/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
