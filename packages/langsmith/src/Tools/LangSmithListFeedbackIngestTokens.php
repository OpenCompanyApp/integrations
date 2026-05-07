<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Feedback Ingest Tokens.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/feedback/tokens.
 */
class LangSmithListFeedbackIngestTokens extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_feedback_ingest_tokens';
    protected const DESCRIPTION = 'List Feedback Ingest Tokens

Official endpoint: GET /api/v1/feedback/tokens
List all feedback ingest tokens for a run.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: run_id.',
  ),
  'run_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `run_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/feedback/tokens';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'run_id',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
