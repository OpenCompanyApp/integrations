<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Feedback Config Endpoint.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/feedback-configs.
 */
class LangSmithUpdateFeedbackConfigEndpoint extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_feedback_config_endpoint';
    protected const DESCRIPTION = 'Update Feedback Config Endpoint

Official endpoint: PATCH /api/v1/feedback-configs
Update Feedback Config Endpoint.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/feedback-configs';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
