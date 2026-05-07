<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Retrieve the list of OpenID Connect dynamic mappings for the provider setting..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/openid-connect/{provider_setting}/dynamic-mappings/.
 */
class CloudsmithOrgsOpenidConnectDynamicMappingsList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_openid_connect_dynamic_mappings_list';
    protected const DESCRIPTION = 'Retrieve the list of OpenID Connect dynamic mappings for the provider setting.

Official Cloudsmith endpoint: GET /orgs/{org}/openid-connect/{provider_setting}/dynamic-mappings/

Retrieve the list of OpenID Connect dynamic mappings for the provider setting.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
  'provider_setting' => array (
  'type' => 'string',
  'description' => 'provider_setting parameter.',
  'required' => true,
),
  'page' => array (
  'type' => 'string',
  'description' => 'A page number within the paginated result set.',
),
  'page_size' => array (
  'type' => 'string',
  'description' => 'Number of results to return per page.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org}/openid-connect/{provider_setting}/dynamic-mappings/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
  'provider_setting' => 'provider_setting',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
