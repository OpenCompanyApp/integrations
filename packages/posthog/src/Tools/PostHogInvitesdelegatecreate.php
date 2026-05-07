<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Create an onboarding delegation invite: an admin-level invite flagged as a setup delegation. Sends a single dedicated...
 */
class PostHogInvitesdelegatecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_invitesdelegatecreate';
}
