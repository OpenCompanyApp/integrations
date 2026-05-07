<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Generate a human-readable text representation of an LLM trace event. This endpoint converts LLM analytics events ($ai...
 */
class PostHogLlmanalyticstextreprcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_llmanalyticstextreprcreate';
}
