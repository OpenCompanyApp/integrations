<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get dataset statistics.
 *
 * Executes the official Apify API operation dataset_statistics_get.
 */
class ApifyDatasetStatisticsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_dataset_statistics_get';
}
