<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Audit trail for a single insight - every change made to it, by whom, and when. Use this when you want the change hist...
 */
class PostHogInsightsactivityretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_insightsactivityretrieve';
}
