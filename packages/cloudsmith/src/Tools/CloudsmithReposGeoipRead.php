<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * List all repository geoip rules..
 *
 * Maps to the official Cloudsmith endpoint get /repos/{owner}/{identifier}/geoip.
 */
class CloudsmithReposGeoipRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_geoip_read';
    protected const DESCRIPTION = 'List all repository geoip rules.

Official Cloudsmith endpoint: GET /repos/{owner}/{identifier}/geoip

List all repository geoip rules.';
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
    protected const PATH = '/repos/{owner}/{identifier}/geoip';
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
