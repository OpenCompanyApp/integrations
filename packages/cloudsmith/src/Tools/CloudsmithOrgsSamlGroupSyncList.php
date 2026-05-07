<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get the details of all SAML Group Sync mapping within an organization..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/saml-group-sync/.
 */
class CloudsmithOrgsSamlGroupSyncList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_saml_group_sync_list';
    protected const DESCRIPTION = 'Get the details of all SAML Group Sync mapping within an organization.

Official Cloudsmith endpoint: GET /orgs/{org}/saml-group-sync/

Get the details of all SAML Group Sync mapping within an organization.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org}/saml-group-sync/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
