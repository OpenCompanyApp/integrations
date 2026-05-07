<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Snapshots overview for a repo: every identifier with a current baseline (latest non-superseded master/main run per ru...
 */
class PostHogVisualreviewreposbaselinesretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_visualreviewreposbaselinesretrieve';
}
