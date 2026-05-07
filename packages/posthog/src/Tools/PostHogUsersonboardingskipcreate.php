<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Mark the current user as having exited onboarding with a non-delegated reason. Idempotent: the skip timestamp is only...
 */
class PostHogUsersonboardingskipcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_usersonboardingskipcreate';
}
