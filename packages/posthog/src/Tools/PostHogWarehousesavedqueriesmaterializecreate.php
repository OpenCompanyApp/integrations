<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Enable materialization for this saved query with a 24-hour sync frequency.
 */
class PostHogWarehousesavedqueriesmaterializecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_warehousesavedqueriesmaterializecreate';
}
