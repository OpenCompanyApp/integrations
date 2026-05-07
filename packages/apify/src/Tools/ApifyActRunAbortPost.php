<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Abort run.
 *
 * Executes the official Apify API operation act_run_abort_post.
 */
class ApifyActRunAbortPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_run_abort_post';
}
