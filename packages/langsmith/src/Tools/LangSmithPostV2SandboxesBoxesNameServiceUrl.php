<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Generate a service access token.
 *
 * Maps to the official LangSmith endpoint POST /v2/sandboxes/boxes/{name}/service-url.
 */
class LangSmithPostV2SandboxesBoxesNameServiceUrl extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v2_sandboxes_boxes_name_service_url';
    protected const DESCRIPTION = 'Generate a service access token

Official endpoint: POST /v2/sandboxes/boxes/{name}/service-url
Create a short-lived JWT for accessing an HTTP service running on a specific port inside a sandbox. Returns a browser_url (sets auth cookie via redirect), a service_url (for use with the X-Langsmith-Sandbox-Service-Token header), the raw token, and its expiry.';
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
    protected const PATH = '/v2/sandboxes/boxes/{name}/service-url';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
