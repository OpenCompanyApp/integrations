<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Abort build.
 *
 * Executes the official Apify API operation actorBuild_abort_post.
 */
class ApifyActorBuildAbortPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_build_abort_post';
}
