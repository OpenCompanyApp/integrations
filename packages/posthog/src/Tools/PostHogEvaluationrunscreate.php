<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Create a new evaluation run. This endpoint validates the request and enqueues a Temporal workflow to asynchronously e...
 */
class PostHogEvaluationrunscreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_evaluationrunscreate';
}
