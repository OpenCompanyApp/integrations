<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Mint a User OAuth URL to bootstrap a fresh code when the install flow returns without one.
 */
class PostHogEnvironmentsintegrationsgithuboauthauthorizecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsintegrationsgithuboauthauthorizecreate';
}
