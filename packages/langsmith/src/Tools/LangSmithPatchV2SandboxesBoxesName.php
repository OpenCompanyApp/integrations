<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update a sandbox claim.
 *
 * Maps to the official LangSmith endpoint PATCH /v2/sandboxes/boxes/{name}.
 */
class LangSmithPatchV2SandboxesBoxesName extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_patch_v2_sandboxes_boxes_name';
    protected const DESCRIPTION = 'Update a sandbox claim

Official endpoint: PATCH /v2/sandboxes/boxes/{name}
Update a sandbox claim\'s display name. The name must be unique within the tenant.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v2/sandboxes/boxes/{name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
