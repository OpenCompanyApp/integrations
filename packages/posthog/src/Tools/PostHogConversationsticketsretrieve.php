<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get single ticket and mark as read by team.
 */
class PostHogConversationsticketsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_conversationsticketsretrieve';
}
