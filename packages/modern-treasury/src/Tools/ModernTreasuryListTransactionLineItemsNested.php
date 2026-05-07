<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list transaction_line_items.
 *
 * Maps to the official Modern Treasury endpoint get /api/transactions/{transaction_id}/line_items.
 */
class ModernTreasuryListTransactionLineItemsNested extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_transaction_line_items_nested';
    protected const DESCRIPTION = 'list transaction_line_items

Official Modern Treasury endpoint: GET /api/transactions/{transaction_id}/line_items

This endpoint has been deprecated in favor of /api/transaction_line_items';
    protected const PARAMETERS = array (
  'transaction_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `transaction_id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/transactions/{transaction_id}/line_items';
    protected const PATH_PARAMS = array (
  'transaction_id' => 'transaction_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
