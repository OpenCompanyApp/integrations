<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Create a new recording and get Recall.ai upload token for the desktop SDK
 */
class PostHogDesktoprecordingscreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_desktoprecordingscreate';
}
