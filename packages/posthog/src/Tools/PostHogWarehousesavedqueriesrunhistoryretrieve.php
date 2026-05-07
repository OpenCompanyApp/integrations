<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Return the recent run history (up to 5 most recent) for this materialized view.
 */
class PostHogWarehousesavedqueriesrunhistoryretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_warehousesavedqueriesrunhistoryretrieve';
}
