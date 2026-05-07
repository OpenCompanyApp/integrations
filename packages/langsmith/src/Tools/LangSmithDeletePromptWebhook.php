<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Prompt Webhook.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/prompt-webhooks/{webhook_id}.
 */
class LangSmithDeletePromptWebhook extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_prompt_webhook';
    protected const DESCRIPTION = 'Delete Prompt Webhook

Official endpoint: DELETE /api/v1/prompt-webhooks/{webhook_id}
Delete a specific prompt webhook.';
    protected const PARAMETERS = array (
  'webhook_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `webhook_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/prompt-webhooks/{webhook_id}';
    protected const PATH_PARAMS = array (
  0 => 'webhook_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
