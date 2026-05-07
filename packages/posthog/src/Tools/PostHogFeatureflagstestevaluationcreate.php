<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Test feature flag evaluation against a specific user at an optional point in time. This endpoint allows testing how a...
 */
class PostHogFeatureflagstestevaluationcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_featureflagstestevaluationcreate';
}
