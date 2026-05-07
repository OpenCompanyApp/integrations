<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get list of archived response UUIDs for HogQL filtering. Returns list of UUIDs that the frontend can use to filter ou...
 */
class PostHogSurveysarchivedresponseuuidsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_surveysarchivedresponseuuidsretrieve';
}
