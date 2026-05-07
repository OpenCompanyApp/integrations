<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get current 2FA status including backup codes if enabled
 */
class PostHogUserstwofactorstatusretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_userstwofactorstatusretrieve';
}
