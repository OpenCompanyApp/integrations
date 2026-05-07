<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get all views associated with a specific managed viewset. GET /api/environments/{teamid}/managedviewsets/{kind}/
 */
class PostHogManagedviewsetsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_managedviewsetsretrieve';
}
