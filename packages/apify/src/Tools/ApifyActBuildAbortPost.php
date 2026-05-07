<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Abort build.
 *
 * Executes the official Apify API operation act_build_abort_post.
 */
class ApifyActBuildAbortPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_build_abort_post';
}
