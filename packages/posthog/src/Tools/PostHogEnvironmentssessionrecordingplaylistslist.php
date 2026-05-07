<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Override list to include synthetic playlists
 */
class PostHogEnvironmentssessionrecordingplaylistslist extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentssessionrecordingplaylistslist';
}
