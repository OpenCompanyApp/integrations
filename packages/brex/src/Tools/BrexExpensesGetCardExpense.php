<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get a card expense.
 *
 * Maps to the official Brex endpoint get /v1/expenses/card/{expense_id}.
 */
class BrexExpensesGetCardExpense extends AbstractBrexTool
{
    protected const NAME = 'brex_expenses_get_card_expense';
    protected const DESCRIPTION = 'Get a card expense

Official Brex endpoint: GET /v1/expenses/card/{expense_id}

This endpoint is deprecated. Use the "Get an expense" (`GET /v1/expenses/{id}`) endpoint instead.';
    protected const PARAMETERS = array (
  'expense_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `expense_id` from the official Brex API operation.',
  ),
  'expand' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `expand[]` from the official Brex API operation.',
  ),
  'load_custom_fields' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `load_custom_fields` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/expenses/card/{expense_id}';
    protected const PATH_PARAMS = array (
  'expense_id' => 'expense_id',
);
    protected const QUERY_PARAMS = array (
  'expand[]' => 'expand',
  'load_custom_fields' => 'load_custom_fields',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
