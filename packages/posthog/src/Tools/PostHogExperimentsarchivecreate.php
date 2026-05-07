<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Archive an ended experiment. Hides the experiment from the default list view. The experiment can be restored at any t...
 */
class PostHogExperimentsarchivecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_experimentsarchivecreate';
}
