<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Return the team settings as of the provided timestamp. Query params: - at: ISO8601 datetime (required) - scope: optio...
 */
class PostHogEnvironmentssettingsasofretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentssettingsasofretrieve';
}
