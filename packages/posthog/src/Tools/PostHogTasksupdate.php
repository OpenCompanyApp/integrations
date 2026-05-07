<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * API for managing tasks within a project. Tasks represent units of work to be performed by an agent.
 */
class PostHogTasksupdate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_tasksupdate';
}
