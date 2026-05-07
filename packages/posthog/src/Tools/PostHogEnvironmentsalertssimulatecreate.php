<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Simulate a detector on an insight's historical data. Read-only - no AlertCheck records are created.
 */
class PostHogEnvironmentsalertssimulatecreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsalertssimulatecreate';
}
