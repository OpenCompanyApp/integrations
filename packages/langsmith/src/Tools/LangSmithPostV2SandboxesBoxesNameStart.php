<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Start a sandbox.
 *
 * Maps to the official LangSmith endpoint POST /v2/sandboxes/boxes/{name}/start.
 */
class LangSmithPostV2SandboxesBoxesNameStart extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v2_sandboxes_boxes_name_start';
    protected const DESCRIPTION = 'Start a sandbox

Official endpoint: POST /v2/sandboxes/boxes/{name}/start
Start a stopped or failed sandbox. This endpoint is not idempotent.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/sandboxes/boxes/{name}/start';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
