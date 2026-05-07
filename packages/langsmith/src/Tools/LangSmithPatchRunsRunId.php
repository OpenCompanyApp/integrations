<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update a Run.
 *
 * Maps to the official LangSmith endpoint PATCH /runs/{run_id}.
 */
class LangSmithPatchRunsRunId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_patch_runs_run_id';
    protected const DESCRIPTION = 'Update a Run

Official endpoint: PATCH /runs/{run_id}
Updates a run identified by its ID. The body should contain only the fields to be changed; unknown fields are ignored.';
    protected const PARAMETERS = array (
  'run_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `run_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/runs/{run_id}';
    protected const PATH_PARAMS = array (
  0 => 'run_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
