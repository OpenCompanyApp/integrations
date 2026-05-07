<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * List all reverse proxies configured for the organization. Returns proxy records along with the maximum number allowed...
 */
class PostHogProxyrecordslist extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_proxyrecordslist';
}
