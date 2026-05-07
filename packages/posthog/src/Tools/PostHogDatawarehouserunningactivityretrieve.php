<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Returns currently running activities (jobs with status 'Running'). Supports pagination and cutoff time filtering.
 */
class PostHogDatawarehouserunningactivityretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_datawarehouserunningactivityretrieve';
}
