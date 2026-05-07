<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List Budgets.
 *
 * Maps to the official Brex endpoint get /v2/budgets.
 */
class BrexBudgetsListSpendBudgets extends AbstractBrexTool
{
    protected const NAME = 'brex_budgets_list_spend_budgets';
    protected const DESCRIPTION = 'List Budgets

Official Brex endpoint: GET /v2/budgets

Retrieves a list of Budgets';
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
    protected const PATH = '/v2/budgets';
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
