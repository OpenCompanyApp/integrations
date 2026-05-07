<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Execute endpoint with optional materialization. Supports version parameter, runs latest version if not set.
 */
class PostHogEnvironmentsendpointsruncreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsendpointsruncreate';
}
