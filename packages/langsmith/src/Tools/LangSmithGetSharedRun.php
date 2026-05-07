<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Shared Run.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/public/{share_token}/run.
 */
class LangSmithGetSharedRun extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_shared_run';
    protected const DESCRIPTION = 'Get Shared Run

Official endpoint: GET /api/v1/public/{share_token}/run
Get the shared run.';
    protected const PARAMETERS = array (
  'share_token' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `share_token`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: exclude_s3_stored_attributes.',
  ),
  'exclude_s3_stored_attributes' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `exclude_s3_stored_attributes`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/public/{share_token}/run';
    protected const PATH_PARAMS = array (
  0 => 'share_token',
);
    protected const QUERY_KEYS = array (
  0 => 'exclude_s3_stored_attributes',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
