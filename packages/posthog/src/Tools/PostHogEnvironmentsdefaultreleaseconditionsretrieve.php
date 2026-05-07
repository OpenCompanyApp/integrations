<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Manage default release conditions for new feature flags in this team.
 */
class PostHogEnvironmentsdefaultreleaseconditionsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsdefaultreleaseconditionsretrieve';
}
