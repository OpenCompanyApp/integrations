<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get user builds list.
 *
 * Executes the official Apify API operation actorBuilds_get.
 */
class ApifyActorBuildsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_builds_get';
}
