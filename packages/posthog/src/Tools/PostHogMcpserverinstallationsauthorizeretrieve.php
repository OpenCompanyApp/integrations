<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Start (or re-start) an OAuth flow. Pass templateid to (re)connect a catalog template, or installationid to reconnect...
 */
class PostHogMcpserverinstallationsauthorizeretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_mcpserverinstallationsauthorizeretrieve';
}
