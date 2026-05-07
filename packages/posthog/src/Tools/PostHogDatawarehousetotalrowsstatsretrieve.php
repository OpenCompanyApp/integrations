<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Returns aggregated statistics for the data warehouse total rows processed within the current billing period. Used by...
 */
class PostHogDatawarehousetotalrowsstatsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_datawarehousetotalrowsstatsretrieve';
}
