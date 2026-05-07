<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Create a new managed reverse proxy. Provide the domain you want to proxy through. The response includes the CNAME tar...
 */
class PostHogProxyrecordscreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_proxyrecordscreate';
}
