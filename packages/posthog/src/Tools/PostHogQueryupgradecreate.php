<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Upgrades a query without executing it. Returns a query with all nodes migrated to the latest version.
 */
class PostHogQueryupgradecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_queryupgradecreate';
}
