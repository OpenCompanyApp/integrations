<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Pause a running experiment. Deactivates the linked feature flag so it is no longer returned by the /decide endpoint....
 */
class PostHogExperimentspausecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_experimentspausecreate';
}
