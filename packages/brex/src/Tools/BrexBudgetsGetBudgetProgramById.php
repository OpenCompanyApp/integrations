<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get Budget Program.
 *
 * Maps to the official Brex endpoint get /v1/budget_programs/{id}.
 */
class BrexBudgetsGetBudgetProgramById extends AbstractBrexTool
{
    protected const NAME = 'brex_budgets_get_budget_program_by_id';
    protected const DESCRIPTION = 'Get Budget Program

Official Brex endpoint: GET /v1/budget_programs/{id}

Retrieves a Budget Program by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/budget_programs/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
