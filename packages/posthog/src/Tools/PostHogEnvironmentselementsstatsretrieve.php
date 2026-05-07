<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * The original version of this API always and only returned $autocapture elements If no include query parameter is sent...
 */
class PostHogEnvironmentselementsstatsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentselementsstatsretrieve';
}
