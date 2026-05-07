<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * ViewSet for listing OAuth applications at the organization level (read-only).
 */
class PostHogOauthapplicationslist extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_oauthapplicationslist';
}
