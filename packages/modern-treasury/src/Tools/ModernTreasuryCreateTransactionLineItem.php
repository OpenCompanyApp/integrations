<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * create transaction line items.
 *
 * Maps to the official Modern Treasury endpoint post /api/transaction_line_items.
 */
class ModernTreasuryCreateTransactionLineItem extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_create_transaction_line_item';
    protected const DESCRIPTION = 'create transaction line items

Official Modern Treasury endpoint: POST /api/transaction_line_items';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Modern Treasury OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/transaction_line_items';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
