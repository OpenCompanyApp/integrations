<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * This endpoint allows you to bulk delete persons, either by the PostHog person IDs or by distinct IDs. You can pass in...
 */
class PostHogPersonsbulkdeletecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_personsbulkdeletecreate';
}
