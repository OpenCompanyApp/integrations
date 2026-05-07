<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Retrieve the SAML Group Sync status for this organization..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/saml-group-sync/status/.
 */
class CloudsmithOrgsSamlGroupSyncStatus extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_saml_group_sync_status';
    protected const DESCRIPTION = 'Retrieve the SAML Group Sync status for this organization.

Official Cloudsmith endpoint: GET /orgs/{org}/saml-group-sync/status/

Retrieve the SAML Group Sync status for this organization.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org}/saml-group-sync/status/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
