<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Create Spend Limit.
 *
 * Maps to the official Brex endpoint post /v2/spend_limits.
 */
class BrexBudgetsCreateSpendLimit extends AbstractBrexTool
{
    protected const NAME = 'brex_budgets_create_spend_limit';
    protected const DESCRIPTION = 'Create Spend Limit

Official Brex endpoint: POST /v2/spend_limits

Creates a Spend Limit';
    protected const PARAMETERS = array (
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
    protected const METHOD = 'post';
    protected const PATH = '/v2/spend_limits';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = true;
}
