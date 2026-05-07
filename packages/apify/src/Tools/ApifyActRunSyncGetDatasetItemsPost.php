<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Run Actor synchronously with input and get dataset items.
 *
 * Executes the official Apify API operation act_runSyncGetDatasetItems_post.
 */
class ApifyActRunSyncGetDatasetItemsPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_run_sync_get_dataset_items_post';
}
