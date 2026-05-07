<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Simulate a logs alert on historical data using the full state machine. Read-only - no alert check records are created.
 */
class PostHogLogsalertssimulatecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_logsalertssimulatecreate';
}
