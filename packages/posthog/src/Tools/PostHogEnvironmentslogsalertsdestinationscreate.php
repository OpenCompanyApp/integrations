<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Create a notification destination for this alert. One HogFunction is created per alert event kind (firing, resolved,...
 */
class PostHogEnvironmentslogsalertsdestinationscreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentslogsalertsdestinationscreate';
}
