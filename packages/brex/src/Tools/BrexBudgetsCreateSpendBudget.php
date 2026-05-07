<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Create Budget.
 *
 * Maps to the official Brex endpoint post /v2/budgets.
 */
class BrexBudgetsCreateSpendBudget extends AbstractBrexTool
{
    protected const NAME = 'brex_budgets_create_spend_budget';
    protected const DESCRIPTION = 'Create Budget

Official Brex endpoint: POST /v2/budgets

Creates a Budget';
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
    protected const PATH = '/v2/budgets';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = true;
}
