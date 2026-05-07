<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Generate AI summary for a group of session recordings to find patterns and generate a notebook.
 */
class PostHogCreatesessionsummaries extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_createsessionsummaries';
}
