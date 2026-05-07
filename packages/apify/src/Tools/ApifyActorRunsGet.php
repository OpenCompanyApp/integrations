<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get user runs list.
 *
 * Executes the official Apify API operation actorRuns_get.
 */
class ApifyActorRunsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_runs_get';
}
