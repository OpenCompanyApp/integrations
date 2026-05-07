<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List primary card account statements..
 *
 * Maps to the official Brex endpoint get /v2/accounts/card/primary/statements.
 */
class BrexTransactionsListPrimaryCardStatements extends AbstractBrexTool
{
    protected const NAME = 'brex_transactions_list_primary_card_statements';
    protected const DESCRIPTION = 'List primary card account statements.

Official Brex endpoint: GET /v2/accounts/card/primary/statements

This endpoint lists all finalized statements for the primary card account.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/accounts/card/primary/statements';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
