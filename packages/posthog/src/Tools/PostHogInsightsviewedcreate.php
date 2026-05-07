<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Update insight view timestamps. Expects: {"insightids": [1, 2, 3, ...]}
 */
class PostHogInsightsviewedcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_insightsviewedcreate';
}
