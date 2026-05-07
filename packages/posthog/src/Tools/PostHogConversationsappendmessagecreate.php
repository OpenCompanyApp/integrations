<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Appends a message to an existing conversation without triggering AI processing. This is used for client-side generate...
 */
class PostHogConversationsappendmessagecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_conversationsappendmessagecreate';
}
