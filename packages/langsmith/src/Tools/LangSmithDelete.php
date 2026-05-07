<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Api Key.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/api-key/{api_key_id}.
 */
class LangSmithDelete extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete';
    protected const DESCRIPTION = 'Delete Api Key

Official endpoint: DELETE /api/v1/api-key/{api_key_id}
Delete an api key for the user';
    protected const PARAMETERS = array (
  'api_key_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `api_key_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/api-key/{api_key_id}';
    protected const PATH_PARAMS = array (
  0 => 'api_key_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
