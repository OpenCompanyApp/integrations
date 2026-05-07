<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a list of all available storage regions..
 *
 * Maps to the official Cloudsmith endpoint get /storage-regions/.
 */
class CloudsmithStorageRegionsList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_storage_regions_list';
    protected const DESCRIPTION = 'Get a list of all available storage regions.

Official Cloudsmith endpoint: GET /storage-regions/

Get a list of all available storage regions.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/storage-regions/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
