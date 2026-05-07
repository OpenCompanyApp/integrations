<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Replace a project and its settings. Prefer the PATCH endpoint for partial updates - PUT requires every writable field...
 */
class PostHogOrganizationsprojectsupdate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_organizationsprojectsupdate';
}
