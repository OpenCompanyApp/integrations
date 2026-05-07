<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Prompt Webhook.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/prompt-webhooks/{webhook_id}.
 */
class LangSmithGetPromptWebhook extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_prompt_webhook';
    protected const DESCRIPTION = 'Get Prompt Webhook

Official endpoint: GET /api/v1/prompt-webhooks/{webhook_id}
Get a specific prompt webhook.';
    protected const PARAMETERS = array (
  'webhook_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `webhook_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/prompt-webhooks/{webhook_id}';
    protected const PATH_PARAMS = array (
  0 => 'webhook_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
