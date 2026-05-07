<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Approve a change request. If quorum is reached, automatically applies the change immediately.
 */
class PostHogChangerequestsapprovecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_changerequestsapprovecreate';
}
