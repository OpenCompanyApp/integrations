<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get Spend Limit.
 *
 * Maps to the official Brex endpoint get /v2/spend_limits/{id}.
 */
class BrexBudgetsGetSpendLimitById extends AbstractBrexTool
{
    protected const NAME = 'brex_budgets_get_spend_limit_by_id';
    protected const DESCRIPTION = 'Get Spend Limit

Official Brex endpoint: GET /v2/spend_limits/{id}

Retrieves a Spend Limit by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/spend_limits/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
