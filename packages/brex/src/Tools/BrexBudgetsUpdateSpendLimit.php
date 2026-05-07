<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Update Spend Limit.
 *
 * Maps to the official Brex endpoint put /v2/spend_limits/{id}.
 */
class BrexBudgetsUpdateSpendLimit extends AbstractBrexTool
{
    protected const NAME = 'brex_budgets_update_spend_limit';
    protected const DESCRIPTION = 'Update Spend Limit

Official Brex endpoint: PUT /v2/spend_limits/{id}

Updates a Spend Limit';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
  'idempotency_key' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Header parameter `Idempotency-Key` from the official Brex API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v2/spend_limits/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = true;
}
