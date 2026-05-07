<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get possible values for a feature flag. Query parameters: - key: The flag ID (required) Returns: - Array of objects w...
 */
class PostHogFlagvaluevaluesretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_flagvaluevaluesretrieve';
}
