<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get a single run.
 *
 * Maps to the official LangSmith endpoint GET /v2/runs/{run_id}.
 */
class LangSmithGetV2RunsRunId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v2_runs_run_id';
    protected const DESCRIPTION = 'Get a single run

Official endpoint: GET /v2/runs/{run_id}
**Alpha:** The request and response contract may change; Returns one run by ID for the given session and start_time. Use the `selects` query parameter (repeatable) to select fields to return.';
    protected const PARAMETERS = array (
  'run_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `run_id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: project_id, selects, start_time.',
  ),
  'project_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `project_id`.',
  ),
  'selects' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `selects`.',
  ),
  'start_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `start_time`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v2/runs/{run_id}';
    protected const PATH_PARAMS = array (
  0 => 'run_id',
);
    protected const QUERY_KEYS = array (
  0 => 'project_id',
  1 => 'selects',
  2 => 'start_time',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
