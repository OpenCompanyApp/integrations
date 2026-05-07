<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Replay a single blocked run. Django fetches the event, Node creates the invocation and writes the log.
 */
class PostHogEnvironmentshogflowsreplayblockedruncreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentshogflowsreplayblockedruncreate';
}
