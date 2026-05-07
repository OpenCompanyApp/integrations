<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List Spend Limits.
 *
 * Maps to the official Brex endpoint get /v1/budgets.
 */
class BrexBudgetsListBudgets extends AbstractBrexTool
{
    protected const NAME = 'brex_budgets_list_budgets';
    protected const DESCRIPTION = 'List Spend Limits

Official Brex endpoint: GET /v1/budgets

Lists Spend Limits belonging to this account';
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
    protected const PATH = '/v1/budgets';
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
