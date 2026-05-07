<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Append transcript segments (supports batched real-time streaming)
 */
class PostHogDesktoprecordingsappendsegmentscreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_desktoprecordingsappendsegmentscreate';
}
