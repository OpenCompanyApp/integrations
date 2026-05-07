<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Disable 2FA and remove all related devices
 */
class PostHogUserstwofactordisablecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_userstwofactordisablecreate';
}
