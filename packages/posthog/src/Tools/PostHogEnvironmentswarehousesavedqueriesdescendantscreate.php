<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Return the descendants of this saved query. By default, we return the immediate children. The level parameter can be...
 */
class PostHogEnvironmentswarehousesavedqueriesdescendantscreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentswarehousesavedqueriesdescendantscreate';
}
