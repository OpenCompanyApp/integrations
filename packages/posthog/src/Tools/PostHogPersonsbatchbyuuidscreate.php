<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * This endpoint is meant for reading and deleting persons. To create or update persons, we recommend using the [capture...
 */
class PostHogPersonsbatchbyuuidscreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_personsbatchbyuuidscreate';
}
