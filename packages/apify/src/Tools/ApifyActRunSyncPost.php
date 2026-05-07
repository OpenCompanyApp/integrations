<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Run Actor synchronously with input and return output.
 *
 * Executes the official Apify API operation act_runSync_post.
 */
class ApifyActRunSyncPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_run_sync_post';
}
