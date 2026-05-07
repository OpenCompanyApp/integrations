<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Enable or disable a managed viewset by kind. PUT /api/environments/{teamid}/managedviewsets/{kind}/ with body {"enabl...
 */
class PostHogManagedviewsetsupdate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_managedviewsetsupdate';
}
