<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Replay all blocked runs in a single bulk call to Node.
 */
class PostHogHogflowsreplayallblockedrunscreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_hogflowsreplayallblockedrunscreate';
}
