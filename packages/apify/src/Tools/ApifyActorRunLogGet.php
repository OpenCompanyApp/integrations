<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get run's log.
 *
 * Executes the official Apify API operation actorRun_log_get.
 */
class ApifyActorRunLogGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_log_get';
}
