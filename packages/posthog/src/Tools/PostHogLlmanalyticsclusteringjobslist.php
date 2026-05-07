<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * CRUD for clustering job configurations (max 5 per team).
 */
class PostHogLlmanalyticsclusteringjobslist extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_llmanalyticsclusteringjobslist';
}
