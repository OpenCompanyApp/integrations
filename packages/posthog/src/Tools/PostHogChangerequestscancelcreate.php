<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Cancel a change request. Only the requester can cancel their own pending change request.
 */
class PostHogChangerequestscancelcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_changerequestscancelcreate';
}
