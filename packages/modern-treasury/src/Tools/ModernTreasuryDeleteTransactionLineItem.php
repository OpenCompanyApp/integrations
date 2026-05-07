<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * delete transaction line item.
 *
 * Maps to the official Modern Treasury endpoint delete /api/transaction_line_items/{id}.
 */
class ModernTreasuryDeleteTransactionLineItem extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_delete_transaction_line_item';
    protected const DESCRIPTION = 'delete transaction line item

Official Modern Treasury endpoint: DELETE /api/transaction_line_items/{id}';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/transaction_line_items/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
