<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Update an expense.
 *
 * Maps to the official Brex endpoint put /v1/expenses/card/{expense_id}.
 */
class BrexExpensesUpdateExpense extends AbstractBrexTool
{
    protected const NAME = 'brex_expenses_update_expense';
    protected const DESCRIPTION = 'Update an expense

Official Brex endpoint: PUT /v1/expenses/card/{expense_id}

Update an expense. Admin and bookkeeper have access to any expense, and regular users can only access their own.';
    protected const PARAMETERS = array (
  'expense_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `expense_id` from the official Brex API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/expenses/card/{expense_id}';
    protected const PATH_PARAMS = array (
  'expense_id' => 'expense_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
