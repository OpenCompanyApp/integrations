<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Create or update the event filter config.
 */
class PostHogEventfiltercreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_eventfiltercreate';
}
