<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Mixin for ViewSets to handle ApprovalRequired exceptions from decorated serializers. This mixin intercepts ApprovalRe...
 */
class PostHogExperimentscreateexposurecohortforexperimentcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_experimentscreateexposurecohortforexperimentcreate';
}
