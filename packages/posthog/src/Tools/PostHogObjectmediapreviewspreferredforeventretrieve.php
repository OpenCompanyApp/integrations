<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get the preferred media preview for an event definition. Most recent user-uploaded, then most recent exported asset....
 */
class PostHogObjectmediapreviewspreferredforeventretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_objectmediapreviewspreferredforeventretrieve';
}
