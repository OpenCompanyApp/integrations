<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Shared Delta.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/public/{share_token}/datasets/runs/delta.
 */
class LangSmithReadSharedDelta extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_shared_delta';
    protected const DESCRIPTION = 'Read Shared Delta

Official endpoint: POST /api/v1/public/{share_token}/datasets/runs/delta
Fetch the number of regressions/improvements for each example in a dataset, between sessions[0] and sessions[1].';
    protected const PARAMETERS = array (
  'share_token' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `share_token`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/public/{share_token}/datasets/runs/delta';
    protected const PATH_PARAMS = array (
  0 => 'share_token',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
