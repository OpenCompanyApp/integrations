<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Submit an NPS response.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/nps/response.
 */
class LangSmithPostV1PlatformNpsResponse extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_nps_response';
    protected const DESCRIPTION = 'Submit an NPS response

Official endpoint: POST /v1/platform/nps/response
Records the authenticated user\'s NPS score and optional comment.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/platform/nps/response';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
