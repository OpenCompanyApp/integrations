<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Update an experiment. Use this to modify experiment properties such as name, description, metrics, variants, and conf...
 */
class PostHogExperimentspartialupdate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_experimentspartialupdate';
}
