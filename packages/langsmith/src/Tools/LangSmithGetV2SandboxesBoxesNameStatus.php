<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get sandbox claim status.
 *
 * Maps to the official LangSmith endpoint GET /v2/sandboxes/boxes/{name}/status.
 */
class LangSmithGetV2SandboxesBoxesNameStatus extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v2_sandboxes_boxes_name_status';
    protected const DESCRIPTION = 'Get sandbox claim status

Official endpoint: GET /v2/sandboxes/boxes/{name}/status
Retrieve the lightweight status of a sandbox claim for polling.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v2/sandboxes/boxes/{name}/status';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
