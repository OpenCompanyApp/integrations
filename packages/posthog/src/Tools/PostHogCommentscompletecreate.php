<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Mark a task-comment as complete. Sets completedat and completedby. 400 if the comment is not a task or is already com...
 */
class PostHogCommentscompletecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_commentscompletecreate';
}
