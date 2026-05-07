<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Delete an endpoint and clean up materialized query.
 */
class PostHogEnvironmentsendpointsdestroy extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsendpointsdestroy';
}
