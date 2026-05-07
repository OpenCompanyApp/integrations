<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Feedback Config Endpoint.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/feedback-configs.
 */
class LangSmithDeleteFeedbackConfigEndpoint extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_feedback_config_endpoint';
    protected const DESCRIPTION = 'Delete Feedback Config Endpoint

Official endpoint: DELETE /api/v1/feedback-configs
Soft delete a feedback config by marking it as deleted. The config can be recreated later with the same key (simple reuse pattern). Existing feedback records with this key will remain unchanged.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: feedback_key.',
  ),
  'feedback_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `feedback_key`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/feedback-configs';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'feedback_key',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
