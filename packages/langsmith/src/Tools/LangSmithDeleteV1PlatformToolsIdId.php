<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete a tool by ID.
 *
 * Maps to the official LangSmith endpoint DELETE /v1/platform/tools/id/{id}.
 */
class LangSmithDeleteV1PlatformToolsIdId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v1_platform_tools_id_id';
    protected const DESCRIPTION = 'Delete a tool by ID

Official endpoint: DELETE /v1/platform/tools/id/{id}
Deletes a tool identified by its UUID.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/platform/tools/id/{id}';
    protected const PATH_PARAMS = array (
  0 => 'id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
