<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get internal account.
 *
 * Maps to the official Modern Treasury endpoint get /api/internal_accounts/{id}.
 */
class ModernTreasuryGetInternalAccount extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_internal_account';
    protected const DESCRIPTION = 'get internal account

Official Modern Treasury endpoint: GET /api/internal_accounts/{id}';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
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
