<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Returns completed/non-running activities (jobs with status 'Completed'). Supports pagination and cutoff time filtering.
 */
class PostHogEnvironmentsdatawarehousecompletedactivityretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsdatawarehousecompletedactivityretrieve';
}
