<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Unarchive an archived experiment. Restores the experiment to the default list view. Returns 400 if the experiment is...
 */
class PostHogExperimentsunarchivecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_experimentsunarchivecreate';
}
