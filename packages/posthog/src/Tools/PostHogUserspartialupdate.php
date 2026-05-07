<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Update one or more of the authenticated user's profile fields or settings.
 */
class PostHogUserspartialupdate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_userspartialupdate';
}
