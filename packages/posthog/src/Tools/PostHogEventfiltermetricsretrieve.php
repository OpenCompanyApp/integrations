<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Single event filter per team. GET /eventfilter/ - returns the config (or null if not yet created) POST /eventfilter/...
 */
class PostHogEventfiltermetricsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_eventfiltermetricsretrieve';
}
