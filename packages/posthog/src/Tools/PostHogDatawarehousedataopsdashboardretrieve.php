<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Returns the data ops overview dashboard ID for this team, creating it if it doesn't exist yet.
 */
class PostHogDatawarehousedataopsdashboardretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_datawarehousedataopsdashboardretrieve';
}
