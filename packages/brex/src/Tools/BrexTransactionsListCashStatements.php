<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List cash account statements..
 *
 * Maps to the official Brex endpoint get /v2/accounts/cash/{id}/statements.
 */
class BrexTransactionsListCashStatements extends AbstractBrexTool
{
    protected const NAME = 'brex_transactions_list_cash_statements';
    protected const DESCRIPTION = 'List cash account statements.

Official Brex endpoint: GET /v2/accounts/cash/{id}/statements

This endpoint lists all finalized statements for the cash account by ID.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/accounts/cash/{id}/statements';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
