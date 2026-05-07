<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Duplicate a survey to multiple projects in a single transaction. Accepts a list of target team IDs and creates a copy...
 */
class PostHogSurveysduplicatetoprojectscreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_surveysduplicatetoprojectscreate';
}
