<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Run.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/runs/{run_id}.
 */
class LangSmithUpdateRun extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_run';
    protected const DESCRIPTION = 'Update Run

Official endpoint: PATCH /api/v1/runs/{run_id}
Update a run.';
    protected const PARAMETERS = array (
  'run_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `run_id`.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/runs/{run_id}';
    protected const PATH_PARAMS = array (
  0 => 'run_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
