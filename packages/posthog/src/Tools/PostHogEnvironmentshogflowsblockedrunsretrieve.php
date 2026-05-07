<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * List workflow runs that were blocked by the dedup bug.
 */
class PostHogEnvironmentshogflowsblockedrunsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentshogflowsblockedrunsretrieve';
}
