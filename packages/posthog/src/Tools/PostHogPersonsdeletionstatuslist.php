<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * List the status of queued event deletions for persons. When you delete a person with deleteevents=true, an async dele...
 */
class PostHogPersonsdeletionstatuslist extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_personsdeletionstatuslist';
}
