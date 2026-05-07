<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get person properties as they existed at a specific point in time. This endpoint reconstructs person properties by qu...
 */
class PostHogEnvironmentspersonspropertiesattimeretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentspersonspropertiesattimeretrieve';
}
