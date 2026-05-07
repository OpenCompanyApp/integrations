<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Shared Run By Id.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/public/{share_token}/run/{id}.
 */
class LangSmithGetSharedRunById extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_shared_run_by_id';
    protected const DESCRIPTION = 'Get Shared Run By Id

Official endpoint: GET /api/v1/public/{share_token}/run/{id}
Get the shared run.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`.',
  ),
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
    protected const PATH = '/api/v1/public/{share_token}/run/{id}';
    protected const PATH_PARAMS = array (
  0 => 'id',
  1 => 'share_token',
);
    protected const QUERY_KEYS = array (
  0 => 'exclude_s3_stored_attributes',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
