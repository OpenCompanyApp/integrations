<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Dashboard.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/orgs/current/dashboard.
 */
class LangSmithGetDashboard extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_dashboard';
    protected const DESCRIPTION = 'Get Dashboard

Official endpoint: GET /api/v1/orgs/current/dashboard
Get Dashboard.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: type, color_scheme.',
  ),
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `type`.',
  ),
  'color_scheme' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `color_scheme`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/orgs/current/dashboard';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'type',
  1 => 'color_scheme',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
