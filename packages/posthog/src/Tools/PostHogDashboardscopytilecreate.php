<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Copy an existing dashboard tile to another dashboard (insight or text card; new tile row).
 */
class PostHogDashboardscopytilecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_dashboardscopytilecreate';
}
