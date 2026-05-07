<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Retrieve a single experiment by ID, including its current status, metrics, feature flag, and results metadata.
 */
class PostHogExperimentsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_experimentsretrieve';
}
