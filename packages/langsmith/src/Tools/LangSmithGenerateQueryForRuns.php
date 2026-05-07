<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Generate Query For Runs.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/runs/generate-query.
 */
class LangSmithGenerateQueryForRuns extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_generate_query_for_runs';
    protected const DESCRIPTION = 'Generate Query For Runs

Official endpoint: POST /api/v1/runs/generate-query
Get runs filter expression query for a given natural language query.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/runs/generate-query';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
