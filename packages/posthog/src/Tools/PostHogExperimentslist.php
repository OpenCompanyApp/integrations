<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * List experiments for the current project. Supports filtering by status and archival state.
 */
class PostHogExperimentslist extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_experimentslist';
}
