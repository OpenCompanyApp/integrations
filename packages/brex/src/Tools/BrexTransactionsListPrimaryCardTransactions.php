<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List transactions for all card accounts..
 *
 * Maps to the official Brex endpoint get /v2/transactions/card/primary.
 */
class BrexTransactionsListPrimaryCardTransactions extends AbstractBrexTool
{
    protected const NAME = 'brex_transactions_list_primary_card_transactions';
    protected const DESCRIPTION = 'List transactions for all card accounts.

Official Brex endpoint: GET /v2/transactions/card/primary

This endpoint lists all settled transactions for all card accounts. Regular users may only fetch their own "PURCHASE","REFUND" and "CHARGEBACK" settled transactions.';
    protected const PARAMETERS = array (
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
  'user_ids' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `user_ids` from the official Brex API operation.',
  ),
  'posted_at_start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `posted_at_start` from the official Brex API operation.',
  ),
  'expand' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `expand[]` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/transactions/card/primary';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
  'user_ids' => 'user_ids',
  'posted_at_start' => 'posted_at_start',
  'expand[]' => 'expand',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
