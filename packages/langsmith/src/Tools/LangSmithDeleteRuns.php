<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Runs.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/runs/delete.
 */
class LangSmithDeleteRuns extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_runs';
    protected const DESCRIPTION = 'Delete Runs

Official endpoint: POST /api/v1/runs/delete
Delete specific runs by trace IDs.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/runs/delete';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
