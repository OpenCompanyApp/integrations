<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Return the count of immediate upstream and downstream dependencies for this saved query.
 */
class PostHogWarehousesavedqueriesdependenciesretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_warehousesavedqueriesdependenciesretrieve';
}
