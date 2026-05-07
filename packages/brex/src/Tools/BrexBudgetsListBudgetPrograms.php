<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List Budget Programs.
 *
 * Maps to the official Brex endpoint get /v1/budget_programs.
 */
class BrexBudgetsListBudgetPrograms extends AbstractBrexTool
{
    protected const NAME = 'brex_budgets_list_budget_programs';
    protected const DESCRIPTION = 'List Budget Programs

Official Brex endpoint: GET /v1/budget_programs

Lists Budget Programs belonging to this account';
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
    protected const PATH = '/v1/budget_programs';
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
