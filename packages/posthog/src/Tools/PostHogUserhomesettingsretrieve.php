<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get the authenticated user's pinned sidebar tabs and configured homepage for the current team. Pass @me as the UUID.
 */
class PostHogUserhomesettingsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_userhomesettingsretrieve';
}
