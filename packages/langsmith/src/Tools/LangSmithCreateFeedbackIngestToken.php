<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Feedback Ingest Token.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/feedback/tokens.
 */
class LangSmithCreateFeedbackIngestToken extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_feedback_ingest_token';
    protected const DESCRIPTION = 'Create Feedback Ingest Token

Official endpoint: POST /api/v1/feedback/tokens
Create a new feedback ingest token.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/feedback/tokens';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
