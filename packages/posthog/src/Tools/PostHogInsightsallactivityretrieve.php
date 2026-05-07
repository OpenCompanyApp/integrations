<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Project-wide audit trail across all insights - who created, edited, deleted, or restored insights, what changed (with...
 */
class PostHogInsightsallactivityretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_insightsallactivityretrieve';
}
