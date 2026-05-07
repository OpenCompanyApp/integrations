<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Capture a snapshot from a sandbox.
 *
 * Maps to the official LangSmith endpoint POST /v2/sandboxes/boxes/{name}/snapshot.
 */
class LangSmithPostV2SandboxesBoxesNameSnapshot extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v2_sandboxes_boxes_name_snapshot';
    protected const DESCRIPTION = 'Capture a snapshot from a sandbox

Official endpoint: POST /v2/sandboxes/boxes/{name}/snapshot
Create a snapshot by capturing the current state of a sandbox or promoting an existing checkpoint.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/v2/sandboxes/boxes/{name}/snapshot';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
