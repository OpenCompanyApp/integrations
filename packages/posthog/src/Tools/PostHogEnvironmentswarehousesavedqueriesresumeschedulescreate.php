<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Resume paused materialization schedules for multiple matviews. Accepts a list of view IDs in the request body: {"view...
 */
class PostHogEnvironmentswarehousesavedqueriesresumeschedulescreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentswarehousesavedqueriesresumeschedulescreate';
}
