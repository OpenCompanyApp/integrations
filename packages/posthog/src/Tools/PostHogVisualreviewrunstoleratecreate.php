<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Mark a changed snapshot as a known tolerated alternate.
 */
class PostHogVisualreviewrunstoleratecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_visualreviewrunstoleratecreate';
}
