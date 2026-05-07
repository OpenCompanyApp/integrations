<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Deprecated: use /api/environments/{id}/ instead.
 */
class PostHogEnvironmentsresettokenpartialupdate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsresettokenpartialupdate';
}
