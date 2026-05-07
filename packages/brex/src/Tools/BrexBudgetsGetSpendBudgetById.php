<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get Budget.
 *
 * Maps to the official Brex endpoint get /v2/budgets/{id}.
 */
class BrexBudgetsGetSpendBudgetById extends AbstractBrexTool
{
    protected const NAME = 'brex_budgets_get_spend_budget_by_id';
    protected const DESCRIPTION = 'Get Budget

Official Brex endpoint: GET /v2/budgets/{id}

Retrieves a Budget by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/budgets/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
