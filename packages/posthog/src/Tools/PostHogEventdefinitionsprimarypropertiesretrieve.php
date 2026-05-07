<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Resolve team-configured primary properties for event definitions. The response only contains entries where a non-null...
 */
class PostHogEventdefinitionsprimarypropertiesretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_eventdefinitionsprimarypropertiesretrieve';
}
