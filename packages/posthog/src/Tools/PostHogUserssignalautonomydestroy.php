<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Per-user signal autonomy config (singleton keyed by user). GET /api/users/ /signalautonomy/ - current config (or 404)...
 */
class PostHogUserssignalautonomydestroy extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_userssignalautonomydestroy';
}
