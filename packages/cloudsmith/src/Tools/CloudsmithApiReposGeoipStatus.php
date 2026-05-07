<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Retrieve the GeoIP status for this repository..
 *
 * Maps to the official Cloudsmith endpoint get /repos/{owner}/{identifier}/geoip/status/.
 */
class CloudsmithApiReposGeoipStatus extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_api_repos_geoip_status';
    protected const DESCRIPTION = 'Retrieve the GeoIP status for this repository.

Official Cloudsmith endpoint: GET /repos/{owner}/{identifier}/geoip/status/

Retrieve the GeoIP status for this repository.';
    protected const PARAMETERS = array (
  'owner' => array (
  'type' => 'string',
  'description' => 'owner parameter.',
  'required' => true,
),
  'identifier' => array (
  'type' => 'string',
  'description' => 'identifier parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/repos/{owner}/{identifier}/geoip/status/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'identifier' => 'identifier',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
