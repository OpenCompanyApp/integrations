<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get build's Log.
 *
 * Executes the official Apify API operation actorBuild_log_get.
 */
class ApifyActorBuildLogGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_build_log_get';
}
