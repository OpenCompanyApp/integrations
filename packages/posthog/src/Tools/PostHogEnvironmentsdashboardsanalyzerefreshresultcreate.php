<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Generate AI analysis comparing before/after dashboard refresh. Expects cachekey in request body pointing to the store...
 */
class PostHogEnvironmentsdashboardsanalyzerefreshresultcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsdashboardsanalyzerefreshresultcreate';
}
