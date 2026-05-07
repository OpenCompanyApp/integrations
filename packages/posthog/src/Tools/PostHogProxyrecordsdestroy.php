<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Delete a reverse proxy. For proxies in 'waiting', 'erroring', or 'timedout' status, the record is deleted immediately...
 */
class PostHogProxyrecordsdestroy extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_proxyrecordsdestroy';
}
