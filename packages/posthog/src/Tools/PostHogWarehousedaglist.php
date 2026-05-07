<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Return this team's DAG as a set of edges and nodes
 */
class PostHogWarehousedaglist extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_warehousedaglist';
}
