<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Snapshot the current dashboard state (from cache) for AI analysis. Returns a cachekey representing the 'before' state...
 */
class PostHogDashboardssnapshotcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_dashboardssnapshotcreate';
}
