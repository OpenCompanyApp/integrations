<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Returns the event filter config for the team, or null if not yet created.
 */
class PostHogEventfilterretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_eventfilterretrieve';
}
