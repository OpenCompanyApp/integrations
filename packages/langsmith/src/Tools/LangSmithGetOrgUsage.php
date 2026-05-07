<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Org Usage.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/orgs/current/billing/usage.
 */
class LangSmithGetOrgUsage extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_org_usage';
    protected const DESCRIPTION = 'Get Org Usage

Official endpoint: GET /api/v1/orgs/current/billing/usage
Get Org Usage.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: starting_on, ending_before, on_current_plan.',
  ),
  'starting_on' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `starting_on`.',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `ending_before`.',
  ),
  'on_current_plan' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `on_current_plan`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/orgs/current/billing/usage';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'starting_on',
  1 => 'ending_before',
  2 => 'on_current_plan',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
