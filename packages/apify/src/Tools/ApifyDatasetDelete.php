<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete dataset.
 *
 * Executes the official Apify API operation dataset_delete.
 */
class ApifyDatasetDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_dataset_delete';
}
