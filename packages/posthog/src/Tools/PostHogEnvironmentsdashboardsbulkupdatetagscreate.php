<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Bulk update tags on multiple objects. Accepts: - {"ids": [...], "action": "add"|"remove"|"set", "tags": ["tag1", "tag...
 */
class PostHogEnvironmentsdashboardsbulkupdatetagscreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsdashboardsbulkupdatetagscreate';
}
