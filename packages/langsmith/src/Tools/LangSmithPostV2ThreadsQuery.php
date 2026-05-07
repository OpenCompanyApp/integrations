<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Query Threads.
 *
 * Maps to the official LangSmith endpoint POST /v2/threads/query.
 */
class LangSmithPostV2ThreadsQuery extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v2_threads_query';
    protected const DESCRIPTION = 'Query Threads

Official endpoint: POST /v2/threads/query
**Alpha:** The request and response contract may change; Query threads within a project (session), with cursor-based pagination. Returns threads matching the given time range and optional filter.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/threads/query';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
