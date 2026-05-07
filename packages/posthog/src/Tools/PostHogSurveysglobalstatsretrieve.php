<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get aggregated response statistics across all surveys. Args: datefrom: Optional ISO timestamp for start date (e.g. 20...
 */
class PostHogSurveysglobalstatsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_surveysglobalstatsretrieve';
}
