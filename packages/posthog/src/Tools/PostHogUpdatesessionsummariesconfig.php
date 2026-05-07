<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Update the team's session summaries configuration (product context used to tailor single-session replay summaries).
 */
class PostHogUpdatesessionsummariesconfig extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_updatesessionsummariesconfig';
}
