<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Feedback Config Endpoint.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/feedback-configs.
 */
class LangSmithCreateFeedbackConfigEndpoint extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_feedback_config_endpoint';
    protected const DESCRIPTION = 'Create Feedback Config Endpoint

Official endpoint: POST /api/v1/feedback-configs
Create Feedback Config Endpoint.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/feedback-configs';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
