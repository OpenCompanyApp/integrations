<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Update one or more of a project's settings. Only the fields included in the request body are changed.
 */
class PostHogOrganizationsprojectspartialupdate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_organizationsprojectspartialupdate';
}
