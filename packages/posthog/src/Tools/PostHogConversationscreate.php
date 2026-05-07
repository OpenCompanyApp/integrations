<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Unified endpoint that handles both conversation creation and streaming. - If message is provided: Start new conversat...
 */
class PostHogConversationscreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_conversationscreate';
}
