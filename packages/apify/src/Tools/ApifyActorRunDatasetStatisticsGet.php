<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get default dataset statistics.
 *
 * Executes the official Apify API operation actorRun_dataset_statistics_get.
 */
class ApifyActorRunDatasetStatisticsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_dataset_statistics_get';
}
