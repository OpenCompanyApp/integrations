<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Query runs.
 *
 * Maps to the official LangSmith endpoint POST /v2/runs/query.
 */
class LangSmithPostV2RunsQuery extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v2_runs_query';
    protected const DESCRIPTION = 'Query runs

Official endpoint: POST /v2/runs/query
**Alpha:** The request and response contract may change; Returns a paginated list of runs for the given projects within min/max start_time. Supports filters, cursor pagination, and `selects` to select fields to return.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/runs/query';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
