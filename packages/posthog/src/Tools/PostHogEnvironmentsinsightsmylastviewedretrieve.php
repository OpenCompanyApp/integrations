<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Returns basic details about the last 5 insights viewed by this user. Most recently viewed first.
 */
class PostHogEnvironmentsinsightsmylastviewedretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsinsightsmylastviewedretrieve';
}
