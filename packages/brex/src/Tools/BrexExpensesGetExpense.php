<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get an expense.
 *
 * Maps to the official Brex endpoint get /v1/expenses/{id}.
 */
class BrexExpensesGetExpense extends AbstractBrexTool
{
    protected const NAME = 'brex_expenses_get_expense';
    protected const DESCRIPTION = 'Get an expense

Official Brex endpoint: GET /v1/expenses/{id}

Get an expense by its ID.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
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
    protected const PATH = '/v1/expenses/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'expand[]' => 'expand',
  'load_custom_fields' => 'load_custom_fields',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
