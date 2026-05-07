<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Prompt Webhook.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/prompt-webhooks.
 */
class LangSmithCreatePromptWebhook extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_prompt_webhook';
    protected const DESCRIPTION = 'Create Prompt Webhook

Official endpoint: POST /api/v1/prompt-webhooks
Create a new prompt webhook.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/prompt-webhooks';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
