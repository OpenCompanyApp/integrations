<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update a tool by ID.
 *
 * Maps to the official LangSmith endpoint PATCH /v1/platform/tools/id/{id}.
 */
class LangSmithPatchV1PlatformToolsIdId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_patch_v1_platform_tools_id_id';
    protected const DESCRIPTION = 'Update a tool by ID

Official endpoint: PATCH /v1/platform/tools/id/{id}
Updates an existing tool identified by its UUID.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/platform/tools/id/{id}';
    protected const PATH_PARAMS = array (
  0 => 'id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
