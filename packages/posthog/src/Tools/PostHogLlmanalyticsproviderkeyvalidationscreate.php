<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Validate LLM provider API keys without persisting them
 */
class PostHogLlmanalyticsproviderkeyvalidationscreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_llmanalyticsproviderkeyvalidationscreate';
}
