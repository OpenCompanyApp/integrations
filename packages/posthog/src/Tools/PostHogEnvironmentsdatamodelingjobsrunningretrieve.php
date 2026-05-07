<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get all currently running jobs from the v2 backend.
 */
class PostHogEnvironmentsdatamodelingjobsrunningretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsdatamodelingjobsrunningretrieve';
}
