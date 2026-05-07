<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Validate Runs Query.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/runs/query/validate.
 */
class LangSmithValidateRunsQuery extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_validate_runs_query';
    protected const DESCRIPTION = 'Validate Runs Query

Official endpoint: POST /api/v1/runs/query/validate
Validate runs query syntax, returns errors for broken queries.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/runs/query/validate';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
