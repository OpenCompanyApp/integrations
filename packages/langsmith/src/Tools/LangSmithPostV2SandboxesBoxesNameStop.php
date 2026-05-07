<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Stop a sandbox.
 *
 * Maps to the official LangSmith endpoint POST /v2/sandboxes/boxes/{name}/stop.
 */
class LangSmithPostV2SandboxesBoxesNameStop extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v2_sandboxes_boxes_name_stop';
    protected const DESCRIPTION = 'Stop a sandbox

Official endpoint: POST /v2/sandboxes/boxes/{name}/stop
Stop a ready sandbox. This endpoint is not idempotent; the filesystem is preserved for later restart.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/sandboxes/boxes/{name}/stop';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
