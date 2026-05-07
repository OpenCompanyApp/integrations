<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Creates an unlisted dashboard from template by tag. Enforces uniqueness (one per tag per team). Returns 409 if unlist...
 */
class PostHogDashboardscreateunlisteddashboardcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_dashboardscreateunlisteddashboardcreate';
}
