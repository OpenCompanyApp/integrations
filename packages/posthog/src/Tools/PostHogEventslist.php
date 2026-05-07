<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * This endpoint allows you to list and filter events. It is effectively deprecated and is kept only for backwards compa...
 */
class PostHogEventslist extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_eventslist';
}
