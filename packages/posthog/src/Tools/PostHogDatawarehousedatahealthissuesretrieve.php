<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Returns failed/disabled data pipeline items for the Pipeline status side panel. Includes: materializations, syncs, so...
 */
class PostHogDatawarehousedatahealthissuesretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_datawarehousedatahealthissuesretrieve';
}
