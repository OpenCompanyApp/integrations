<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Retrieve the list of OpenID Connect provider settings for the org..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/openid-connect/.
 */
class CloudsmithOrgsOpenidConnectList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_openid_connect_list';
    protected const DESCRIPTION = 'Retrieve the list of OpenID Connect provider settings for the org.

Official Cloudsmith endpoint: GET /orgs/{org}/openid-connect/

Retrieve the list of OpenID Connect provider settings for the org.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
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
  'query' => array (
  'type' => 'string',
  'description' => 'A search term for querying of OpenID Connect (OIDC) provider settings.Available options are: name, provider_url, service_account',
),
  'sort' => array (
  'type' => 'string',
  'description' => 'A field for sorting objects in ascending or descending order. Use `-` prefix for descending order (e.g., `-name`). Available options: name.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org}/openid-connect/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
  'query' => 'query',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
