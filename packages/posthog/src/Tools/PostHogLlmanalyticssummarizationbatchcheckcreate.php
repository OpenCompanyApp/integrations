<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Check which traces have cached summaries available. This endpoint allows batch checking of multiple trace IDs to see...
 */
class PostHogLlmanalyticssummarizationbatchcheckcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_llmanalyticssummarizationbatchcheckcreate';
}
