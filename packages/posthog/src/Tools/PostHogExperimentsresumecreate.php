<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Resume a paused experiment. Reactivates the linked feature flag so it is returned by /decide again. Users are re-buck...
 */
class PostHogExperimentsresumecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_experimentsresumecreate';
}
