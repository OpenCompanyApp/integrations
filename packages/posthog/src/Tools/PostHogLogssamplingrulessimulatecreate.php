<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Dry-run estimate for how much volume this rule would remove (placeholder response until CH-backed simulation is wired).
 */
class PostHogLogssamplingrulessimulatecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_logssamplingrulessimulatecreate';
}
