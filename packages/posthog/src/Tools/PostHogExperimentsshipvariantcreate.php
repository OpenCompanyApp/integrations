<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Ship a variant to 100% of users and (optionally) end the experiment. Rewrites the feature flag so that the selected v...
 */
class PostHogExperimentsshipvariantcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_experimentsshipvariantcreate';
}
