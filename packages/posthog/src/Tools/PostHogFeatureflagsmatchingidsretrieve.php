<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get IDs of all feature flags matching the current filters. Uses the same filtering logic as the list endpoint. Return...
 */
class PostHogFeatureflagsmatchingidsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_featureflagsmatchingidsretrieve';
}
