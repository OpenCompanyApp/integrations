<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Reopen a completed task-comment. Clears completedat and completedby. 400 if the comment is not a task or is already o...
 */
class PostHogCommentsreopencreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_commentsreopencreate';
}
