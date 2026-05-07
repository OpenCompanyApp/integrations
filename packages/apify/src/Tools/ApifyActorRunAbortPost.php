<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Abort run.
 *
 * Executes the official Apify API operation actorRun_abort_post.
 */
class ApifyActorRunAbortPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_abort_post';
}
