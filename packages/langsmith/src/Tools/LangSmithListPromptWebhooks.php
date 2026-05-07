<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Prompt Webhooks.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/prompt-webhooks.
 */
class LangSmithListPromptWebhooks extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_prompt_webhooks';
    protected const DESCRIPTION = 'List Prompt Webhooks

Official endpoint: GET /api/v1/prompt-webhooks
List all prompt webhooks for the current tenant.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/prompt-webhooks';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
