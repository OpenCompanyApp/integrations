<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * delete transaction.
 *
 * Maps to the official Modern Treasury endpoint delete /api/transactions/{id}.
 */
class ModernTreasuryDeleteTransaction extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_delete_transaction';
    protected const DESCRIPTION = 'delete transaction

Official Modern Treasury endpoint: DELETE /api/transactions/{id}';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/transactions/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
