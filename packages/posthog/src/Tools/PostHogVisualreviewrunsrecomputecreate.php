<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Re-evaluate quarantine and counts, update commit status, and optionally rerun the CI job.
 */
class PostHogVisualreviewrunsrecomputecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_visualreviewrunsrecomputecreate';
}
