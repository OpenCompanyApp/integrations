<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete a sandbox claim.
 *
 * Maps to the official LangSmith endpoint DELETE /v2/sandboxes/boxes/{name}.
 */
class LangSmithDeleteV2SandboxesBoxesName extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v2_sandboxes_boxes_name';
    protected const DESCRIPTION = 'Delete a sandbox claim

Official endpoint: DELETE /v2/sandboxes/boxes/{name}
Delete a sandbox claim by name or UUID. Tears down the sandbox runtime and removes the DB record.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v2/sandboxes/boxes/{name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
