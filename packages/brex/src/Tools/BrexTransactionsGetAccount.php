<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get cash account by ID.
 *
 * Maps to the official Brex endpoint get /v2/accounts/cash/{id}.
 */
class BrexTransactionsGetAccount extends AbstractBrexTool
{
    protected const NAME = 'brex_transactions_get_account';
    protected const DESCRIPTION = 'Get cash account by ID

Official Brex endpoint: GET /v2/accounts/cash/{id}

This endpoint returns the cash account associated with the provided ID with its status.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/accounts/cash/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
