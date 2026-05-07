<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Internal: start a stopped sandbox (service-to-service).
 *
 * Maps to the official LangSmith endpoint POST /v2/sandboxes/internal/start/{name}.
 */
class LangSmithPostV2SandboxesInternalStartName extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v2_sandboxes_internal_start_name';
    protected const DESCRIPTION = 'Internal: start a stopped sandbox (service-to-service)

Official endpoint: POST /v2/sandboxes/internal/start/{name}
Called by the sandbox-router to wake stopped sandboxes. Blocks until the sandbox is ready or times out. The name parameter accepts either the display name or route name (sb-).';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/sandboxes/internal/start/{name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
