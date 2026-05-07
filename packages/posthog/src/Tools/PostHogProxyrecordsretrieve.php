<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get details of a specific reverse proxy by ID. Returns the full configuration including domain, CNAME target, and cur...
 */
class PostHogProxyrecordsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_proxyrecordsretrieve';
}
