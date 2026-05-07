<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Generate an AI-powered summary of evaluation results. This endpoint analyzes evaluation runs and identifies patterns...
 */
class PostHogLlmanalyticsevaluationsummarycreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_llmanalyticsevaluationsummarycreate';
}
