<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Query Runs.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/runs/query.
 */
class LangSmithQueryRuns extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_query_runs';
    protected const DESCRIPTION = 'Query Runs

Official endpoint: POST /api/v1/runs/query
Query Runs.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/runs/query';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
