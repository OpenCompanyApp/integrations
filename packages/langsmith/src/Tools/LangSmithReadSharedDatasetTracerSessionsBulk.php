<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Shared Dataset Tracer Sessions Bulk.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/public/datasets/sessions-bulk.
 */
class LangSmithReadSharedDatasetTracerSessionsBulk extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_shared_dataset_tracer_sessions_bulk';
    protected const DESCRIPTION = 'Read Shared Dataset Tracer Sessions Bulk

Official endpoint: GET /api/v1/public/datasets/sessions-bulk
Get sessions from multiple datasets using share tokens.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: share_tokens.',
  ),
  'share_tokens' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `share_tokens`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/public/datasets/sessions-bulk';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'share_tokens',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
