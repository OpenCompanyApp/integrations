<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get a sandbox claim.
 *
 * Maps to the official LangSmith endpoint GET /v2/sandboxes/boxes/{name}.
 */
class LangSmithGetV2SandboxesBoxesName extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v2_sandboxes_boxes_name';
    protected const DESCRIPTION = 'Get a sandbox claim

Official endpoint: GET /v2/sandboxes/boxes/{name}
Retrieve a sandbox claim by name. Stale provisioning claims are auto-failed.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v2/sandboxes/boxes/{name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
