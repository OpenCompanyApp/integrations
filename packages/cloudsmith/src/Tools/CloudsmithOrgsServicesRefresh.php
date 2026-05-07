<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Refresh service API token..
 *
 * Maps to the official Cloudsmith endpoint post /orgs/{org}/services/{service}/refresh/.
 */
class CloudsmithOrgsServicesRefresh extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_services_refresh';
    protected const DESCRIPTION = 'Refresh service API token.

Official Cloudsmith endpoint: POST /orgs/{org}/services/{service}/refresh/

Refresh service API token.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
  'service' => array (
  'type' => 'string',
  'description' => 'service parameter.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org}/services/{service}/refresh/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
  'service' => 'service',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
