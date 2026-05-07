<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * delete external account.
 *
 * Maps to the official Modern Treasury endpoint delete /api/external_accounts/{id}.
 */
class ModernTreasuryDeleteExternalAccount extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_delete_external_account';
    protected const DESCRIPTION = 'delete external account

Official Modern Treasury endpoint: DELETE /api/external_accounts/{id}';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'delete';
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
