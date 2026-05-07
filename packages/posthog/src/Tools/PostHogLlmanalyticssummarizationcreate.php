<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Generate an AI-powered summary of an LLM trace or event. This endpoint analyzes the provided trace/event, generates a...
 */
class PostHogLlmanalyticssummarizationcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_llmanalyticssummarizationcreate';
}
