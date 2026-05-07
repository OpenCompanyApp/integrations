<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Returns insights ranked by view count over the last N days (default 7), highest first. Each result includes the same...
 */
class PostHogInsightstrendingretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_insightstrendingretrieve';
}
