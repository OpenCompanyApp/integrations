<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Prompt Webhook.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/prompt-webhooks/{webhook_id}.
 */
class LangSmithUpdatePromptWebhook extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_prompt_webhook';
    protected const DESCRIPTION = 'Update Prompt Webhook

Official endpoint: PATCH /api/v1/prompt-webhooks/{webhook_id}
Update a specific prompt webhook.';
    protected const PARAMETERS = array (
  'webhook_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `webhook_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/prompt-webhooks/{webhook_id}';
    protected const PATH_PARAMS = array (
  0 => 'webhook_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
