<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get list of datasets.
 *
 * Executes the official Apify API operation datasets_get.
 */
class ApifyDatasetsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_datasets_get';
}
