<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Run Actor synchronously without input and get dataset items.
 *
 * Executes the official Apify API operation act_runSyncGetDatasetItems_get.
 */
class ApifyActRunSyncGetDatasetItemsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_run_sync_get_dataset_items_get';
}
