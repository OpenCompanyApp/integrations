<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get the last execution times in the past 6 months for multiple endpoints.
 */
class PostHogEnvironmentsendpointslastexecutiontimescreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsendpointslastexecutiontimescreate';
}
