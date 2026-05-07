<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get default dataset items.
 *
 * Executes the official Apify API operation actorRun_dataset_items_get.
 */
class ApifyActorRunDatasetItemsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_dataset_items_get';
}
