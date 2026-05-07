<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Update an existing endpoint. Parameters are optional. Pass version in body or ?version=N query param to target a spec...
 */
class PostHogEnvironmentsendpointsupdate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsendpointsupdate';
}
