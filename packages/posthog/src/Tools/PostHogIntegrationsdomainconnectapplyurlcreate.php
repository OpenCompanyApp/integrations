<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Unified endpoint for generating Domain Connect apply URLs. Accepts a context ("email" or "proxy") and the relevant re...
 */
class PostHogIntegrationsdomainconnectapplyurlcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_integrationsdomainconnectapplyurlcreate';
}
