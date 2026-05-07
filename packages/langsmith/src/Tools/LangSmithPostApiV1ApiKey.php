<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Generate Api Key.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/api-key.
 */
class LangSmithPostApiV1ApiKey extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_api_v1_api_key';
    protected const DESCRIPTION = 'Generate Api Key

Official endpoint: POST /api/v1/api-key
Generate an api key for the user';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/api-key';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
