<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Return the ancestors of this saved query. By default, we return the immediate parents. The level parameter can be use...
 */
class PostHogEnvironmentswarehousesavedqueriesancestorscreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentswarehousesavedqueriesancestorscreate';
}
