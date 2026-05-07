<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete build.
 *
 * Executes the official Apify API operation actorBuild_delete.
 */
class ApifyActorBuildDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_build_delete';
}
