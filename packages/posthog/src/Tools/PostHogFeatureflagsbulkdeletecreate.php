<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Bulk delete feature flags by filter criteria or explicit IDs. Accepts either: - {"filters": {...}} - Same filter para...
 */
class PostHogFeatureflagsbulkdeletecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_featureflagsbulkdeletecreate';
}
