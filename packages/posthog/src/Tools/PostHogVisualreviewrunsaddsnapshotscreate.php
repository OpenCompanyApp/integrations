<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Add a batch of snapshots to a pending run (shard-based flow).
 */
class PostHogVisualreviewrunsaddsnapshotscreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_visualreviewrunsaddsnapshotscreate';
}
