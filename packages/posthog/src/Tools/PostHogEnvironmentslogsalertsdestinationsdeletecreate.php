<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Delete a notification destination by deleting its HogFunction group atomically.
 */
class PostHogEnvironmentslogsalertsdestinationsdeletecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentslogsalertsdestinationsdeletecreate';
}
