<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Validate CDC prerequisites against a live Postgres connection. Used by the source wizard to surface / checks before s...
 */
class PostHogEnvironmentsexternaldatasourcescheckcdcprerequisitescreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsexternaldatasourcescheckcdcprerequisitescreate';
}
