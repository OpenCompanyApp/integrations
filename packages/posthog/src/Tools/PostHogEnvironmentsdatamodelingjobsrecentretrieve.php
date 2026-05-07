<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get the most recent non-running job for each saved query from the v2 backend.
 */
class PostHogEnvironmentsdatamodelingjobsrecentretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsdatamodelingjobsrecentretrieve';
}
