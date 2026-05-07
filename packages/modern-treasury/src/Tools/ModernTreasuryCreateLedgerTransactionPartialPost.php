<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * create ledger_transaction partial post.
 *
 * Maps to the official Modern Treasury endpoint post /api/ledger_transactions/{id}/partial_post.
 */
class ModernTreasuryCreateLedgerTransactionPartialPost extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_create_ledger_transaction_partial_post';
    protected const DESCRIPTION = 'create ledger_transaction partial post

Official Modern Treasury endpoint: POST /api/ledger_transactions/{id}/partial_post

Create a ledger transaction that partially posts another ledger transaction.';
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
    protected const METHOD = 'post';
    protected const PATH = '/api/ledger_transactions/{id}/partial_post';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
