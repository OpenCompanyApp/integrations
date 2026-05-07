<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Approve visual changes for snapshots in this run. With approveall=true, approves all changed+new snapshots and return...
 */
class PostHogVisualreviewrunsapprovecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_visualreviewrunsapprovecreate';
}
