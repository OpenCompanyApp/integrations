<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * List enabled evaluations currently using trial credits for a given provider.
 */
class PostHogLlmanalyticsproviderkeystrialevaluationsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_llmanalyticsproviderkeystrialevaluationsretrieve';
}
