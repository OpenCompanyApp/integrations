<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get virtual_account.
 *
 * Maps to the official Modern Treasury endpoint get /api/virtual_accounts/{id}.
 */
class ModernTreasuryGetVirtualAccount extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_virtual_account';
    protected const DESCRIPTION = 'get virtual_account

Official Modern Treasury endpoint: GET /api/virtual_accounts/{id}';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/virtual_accounts/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
