<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Explain a log entry using AI. POST /api/environments/:id/logs/explainLogWithAI/
 */
class PostHogLogsexplainLogWithAIcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_logsexplain_log_with_a_icreate';
}
