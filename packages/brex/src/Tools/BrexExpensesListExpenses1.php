<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List card expenses.
 *
 * Maps to the official Brex endpoint get /v1/expenses/card.
 */
class BrexExpensesListExpenses1 extends AbstractBrexTool
{
    protected const NAME = 'brex_expenses_list_expenses_1';
    protected const DESCRIPTION = 'List card expenses

Official Brex endpoint: GET /v1/expenses/card

This endpoint is deprecated. Use the "List expenses" (`GET /v1/expenses`) endpoint instead.';
    protected const PARAMETERS = array (
  'expand' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `expand[]` from the official Brex API operation.',
  ),
  'user_id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `user_id[]` from the official Brex API operation.',
  ),
  'parent_expense_id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `parent_expense_id[]` from the official Brex API operation.',
  ),
  'budget_id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `budget_id[]` from the official Brex API operation.',
  ),
  'spending_entity_id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `spending_entity_id[]` from the official Brex API operation.',
  ),
  'status' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `status[]` from the official Brex API operation.',
  ),
  'payment_status' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `payment_status[]` from the official Brex API operation.',
  ),
  'purchased_at_start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `purchased_at_start` from the official Brex API operation.',
  ),
  'purchased_at_end' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `purchased_at_end` from the official Brex API operation.',
  ),
  'updated_at_start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `updated_at_start` from the official Brex API operation.',
  ),
  'updated_at_end' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `updated_at_end` from the official Brex API operation.',
  ),
  'payment_posted_at_start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `payment_posted_at_start` from the official Brex API operation.',
  ),
  'payment_posted_at_end' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `payment_posted_at_end` from the official Brex API operation.',
  ),
  'load_custom_fields' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `load_custom_fields` from the official Brex API operation.',
  ),
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
    protected const PATH = '/v1/expenses/card';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'expand[]' => 'expand',
  'user_id[]' => 'user_id',
  'parent_expense_id[]' => 'parent_expense_id',
  'budget_id[]' => 'budget_id',
  'spending_entity_id[]' => 'spending_entity_id',
  'status[]' => 'status',
  'payment_status[]' => 'payment_status',
  'purchased_at_start' => 'purchased_at_start',
  'purchased_at_end' => 'purchased_at_end',
  'updated_at_start' => 'updated_at_start',
  'updated_at_end' => 'updated_at_end',
  'payment_posted_at_start' => 'payment_posted_at_start',
  'payment_posted_at_end' => 'payment_posted_at_end',
  'load_custom_fields' => 'load_custom_fields',
  'cursor' => 'cursor',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
