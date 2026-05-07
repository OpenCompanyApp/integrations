<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * ViewSet for organization-level integrations. Provides access to integrations that are scoped to the entire organizati...
 */
class PostHogOrgorganizationsintegrationsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_orgorganizationsintegrationsretrieve';
}
