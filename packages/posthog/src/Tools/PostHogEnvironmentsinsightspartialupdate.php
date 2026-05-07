<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * DRF ViewSet mixin that gates coalesced responses behind permission checks. The QueryCoalescingMiddleware attaches cac...
 */
class PostHogEnvironmentsinsightspartialupdate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsinsightspartialupdate';
}
