<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Set the display order of the current user's shortcuts. orderedids becomes the new top-to-bottom order; any unknown ID...
 */
class PostHogFilesystemshortcutreordercreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_filesystemshortcutreordercreate';
}
