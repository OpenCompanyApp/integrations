<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Generate AI individual summary for each session, without grouping.
 */
class PostHogCreatesessionsummariesindividually extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_createsessionsummariesindividually';
}
