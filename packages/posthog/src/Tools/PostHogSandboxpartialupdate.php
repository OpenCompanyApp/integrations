<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * API for managing sandbox environments that control network access for task runs.
 */
class PostHogSandboxpartialupdate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_sandboxpartialupdate';
}
