<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete run.
 *
 * Executes the official Apify API operation actorRun_delete.
 */
class ApifyActorRunDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_delete';
}
