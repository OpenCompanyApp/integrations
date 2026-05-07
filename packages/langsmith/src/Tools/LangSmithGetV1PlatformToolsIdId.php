<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get a tool by ID.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/tools/id/{id}.
 */
class LangSmithGetV1PlatformToolsIdId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_tools_id_id';
    protected const DESCRIPTION = 'Get a tool by ID

Official endpoint: GET /v1/platform/tools/id/{id}
Returns a tool identified by its UUID.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/tools/id/{id}';
    protected const PATH_PARAMS = array (
  0 => 'id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
