<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Reset a broken alert. Clears the consecutive-failure counter and schedules an immediate recheck.
 */
class PostHogEnvironmentslogsalertsresetcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentslogsalertsresetcreate';
}
