<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Shared Dataset Run.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/public/{share_token}/datasets/runs/{run_id}.
 */
class LangSmithReadSharedDatasetRun extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_shared_dataset_run';
    protected const DESCRIPTION = 'Read Shared Dataset Run

Official endpoint: GET /api/v1/public/{share_token}/datasets/runs/{run_id}
Get runs in projects run over a dataset that has been shared.';
    protected const PARAMETERS = array (
  'run_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `run_id`.',
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
    protected const PATH = '/api/v1/public/{share_token}/datasets/runs/{run_id}';
    protected const PATH_PARAMS = array (
  0 => 'run_id',
  1 => 'share_token',
);
    protected const QUERY_KEYS = array (
  0 => 'exclude_s3_stored_attributes',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
