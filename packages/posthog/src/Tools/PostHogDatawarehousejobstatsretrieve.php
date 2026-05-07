<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Returns success and failed job statistics for the last 1, 7, or 30 days. Query parameter 'days' can be 1, 7, or 30 (d...
 */
class PostHogDatawarehousejobstatsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_datawarehousejobstatsretrieve';
}
