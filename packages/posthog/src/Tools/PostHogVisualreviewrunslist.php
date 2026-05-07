<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * List runs for the team, optionally filtered by review state, PR number, commit SHA, or branch.
 */
class PostHogVisualreviewrunslist extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_visualreviewrunslist';
}
