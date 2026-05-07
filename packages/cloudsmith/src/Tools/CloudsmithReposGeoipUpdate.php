<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Replace repository geoip rules..
 *
 * Maps to the official Cloudsmith endpoint put /repos/{owner}/{identifier}/geoip.
 */
class CloudsmithReposGeoipUpdate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_geoip_update';
    protected const DESCRIPTION = 'Replace repository geoip rules.

Official Cloudsmith endpoint: PUT /repos/{owner}/{identifier}/geoip

Replace repository geoip rules.';
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
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'put';
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
