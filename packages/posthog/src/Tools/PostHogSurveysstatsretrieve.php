<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get survey response statistics for a specific survey. Args: datefrom: Optional ISO timestamp for start date (e.g. 202...
 */
class PostHogSurveysstatsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_surveysstatsretrieve';
}
