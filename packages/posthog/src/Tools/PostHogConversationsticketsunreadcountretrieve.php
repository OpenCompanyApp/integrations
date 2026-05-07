<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get total unread ticket count for the team. Returns the sum of unreadteamcount for all non-resolved tickets. Cached i...
 */
class PostHogConversationsticketsunreadcountretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_conversationsticketsunreadcountretrieve';
}
