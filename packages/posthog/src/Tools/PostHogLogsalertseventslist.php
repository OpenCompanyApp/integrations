<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Paginated event history for this alert, newest first. Returns state transitions, errored checks, and user-initiated c...
 */
class PostHogLogsalertseventslist extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_logsalertseventslist';
}
