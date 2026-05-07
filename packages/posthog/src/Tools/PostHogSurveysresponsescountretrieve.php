<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get response counts for all surveys. Args: excludearchived: Optional boolean to exclude archived responses (default:...
 */
class PostHogSurveysresponsescountretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_surveysresponsescountretrieve';
}
