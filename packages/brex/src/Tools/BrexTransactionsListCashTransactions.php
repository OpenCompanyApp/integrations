<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List transactions for the selected cash account..
 *
 * Maps to the official Brex endpoint get /v2/transactions/cash/{id}.
 */
class BrexTransactionsListCashTransactions extends AbstractBrexTool
{
    protected const NAME = 'brex_transactions_list_cash_transactions';
    protected const DESCRIPTION = 'List transactions for the selected cash account.

Official Brex endpoint: GET /v2/transactions/cash/{id}

This endpoint lists all transactions for the cash account with the selected ID.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Brex API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Brex API operation.',
  ),
  'posted_at_start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `posted_at_start` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/transactions/cash/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
  'posted_at_start' => 'posted_at_start',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
