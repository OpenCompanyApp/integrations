<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a specific storage region..
 *
 * Maps to the official Cloudsmith endpoint get /storage-regions/{slug}/.
 */
class CloudsmithStorageRegionsRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_storage_regions_read';
    protected const DESCRIPTION = 'Get a specific storage region.

Official Cloudsmith endpoint: GET /storage-regions/{slug}/

Get a specific storage region.';
    protected const PARAMETERS = array (
  'slug' => array (
  'type' => 'string',
  'description' => 'slug parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/storage-regions/{slug}/';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
