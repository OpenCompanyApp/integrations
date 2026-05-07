<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Invoke an MCP tool by name. This endpoint allows MCP callers to invoke Max AI tools directly without going through th...
 */
class PostHogMcptoolscreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_mcptoolscreate';
}
