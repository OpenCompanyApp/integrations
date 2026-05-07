<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Test Prompt Webhook.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/prompt-webhooks/test.
 */
class LangSmithTestPromptWebhook extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_test_prompt_webhook';
    protected const DESCRIPTION = 'Test Prompt Webhook

Official endpoint: POST /api/v1/prompt-webhooks/test
Test a specific prompt webhook.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/prompt-webhooks/test';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
