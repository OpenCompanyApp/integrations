<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * API for managing task runs. Each run represents an execution of a task.
 */
class PostHogTasksrunsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_tasksrunsretrieve';
}
