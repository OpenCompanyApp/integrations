<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Launch a draft experiment. Validates the experiment is in draft state, activates its linked feature flag, sets startd...
 */
class PostHogExperimentslaunchcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_experimentslaunchcreate';
}
