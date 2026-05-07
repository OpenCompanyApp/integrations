<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Generate new backup codes, invalidating any existing ones
 */
class PostHogUserstwofactorbackupcodescreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_userstwofactorbackupcodescreate';
}
