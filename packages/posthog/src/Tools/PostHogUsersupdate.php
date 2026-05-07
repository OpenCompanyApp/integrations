<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Replace the authenticated user's profile and settings. Pass @me as the UUID to update the authenticated user. Prefer...
 */
class PostHogUsersupdate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_usersupdate';
}
