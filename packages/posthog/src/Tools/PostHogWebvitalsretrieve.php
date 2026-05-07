<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get web vitals for a specific pathname. Toolbar accesses this via OAuth (handled by TeamAndOrgViewSetMixin.getauthent...
 */
class PostHogWebvitalsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_webvitalsretrieve';
}
