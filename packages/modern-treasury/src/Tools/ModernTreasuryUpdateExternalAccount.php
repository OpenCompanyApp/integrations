<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * update external account.
 *
 * Maps to the official Modern Treasury endpoint patch /api/external_accounts/{id}.
 */
class ModernTreasuryUpdateExternalAccount extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_update_external_account';
    protected const DESCRIPTION = 'update external account

Official Modern Treasury endpoint: PATCH /api/external_accounts/{id}';
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
    protected const PATH = '/api/external_accounts/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
