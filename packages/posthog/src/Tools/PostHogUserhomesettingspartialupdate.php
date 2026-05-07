<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Update the authenticated user's pinned sidebar tabs and/or homepage for the current team. Pass @me as the UUID. Send...
 */
class PostHogUserhomesettingspartialupdate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_userhomesettingspartialupdate';
}
