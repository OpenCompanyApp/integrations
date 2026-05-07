<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Run a deep diagnostic on a reverse proxy. Inspects DNS CNAME alignment, the certificate provider's hostname state, CA...
 */
class PostHogProxyrecordsdiagnosecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_proxyrecordsdiagnosecreate';
}
