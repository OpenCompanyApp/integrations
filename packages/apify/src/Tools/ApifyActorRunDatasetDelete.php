<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete default dataset.
 *
 * Executes the official Apify API operation actorRun_dataset_delete.
 */
class ApifyActorRunDatasetDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_dataset_delete';
}
