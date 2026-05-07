<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get query log details from querylogarchive table for a specific queryid, the query must have been issued in last 24 h...
 */
class PostHogQuerylogretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_querylogretrieve';
}
