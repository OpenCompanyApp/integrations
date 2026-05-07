<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Create a new experiment in draft status with optional metrics.
 */
class PostHogExperimentscreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_experimentscreate';
}
