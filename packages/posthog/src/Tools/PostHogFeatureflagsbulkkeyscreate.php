<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get feature flag keys by IDs. Accepts a list of feature flag IDs and returns a mapping of ID to key.
 */
class PostHogFeatureflagsbulkkeyscreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_featureflagsbulkkeyscreate';
}
