<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Lists curated MCP server templates that users can install with one click. Templates are seeded by PostHog operators a...
 */
class PostHogMcpserverslist extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_mcpserverslist';
}
