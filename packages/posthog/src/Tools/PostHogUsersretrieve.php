<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Retrieve a user's profile and settings. Pass @me as the UUID to fetch the authenticated user; non-staff callers may o...
 */
class PostHogUsersretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_usersretrieve';
}
