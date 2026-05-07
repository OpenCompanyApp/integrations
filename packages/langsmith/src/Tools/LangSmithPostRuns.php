<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create a Run.
 *
 * Maps to the official LangSmith endpoint POST /runs.
 */
class LangSmithPostRuns extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_runs';
    protected const DESCRIPTION = 'Create a Run

Official endpoint: POST /runs
Queues a single run for ingestion. The request body must be a JSON-encoded run object that follows the Run schema.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/runs';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
