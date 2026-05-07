<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Retry provisioning a failed reverse proxy. Only available for proxies in 'erroring' or 'timedout' status. Resets the...
 */
class PostHogProxyrecordsretrycreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_proxyrecordsretrycreate';
}
