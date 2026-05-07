<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Enable SAML Group Sync for this organization..
 *
 * Maps to the official Cloudsmith endpoint post /orgs/{org}/saml-group-sync/enable/.
 */
class CloudsmithOrgsSamlGroupSyncEnable extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_saml_group_sync_enable';
    protected const DESCRIPTION = 'Enable SAML Group Sync for this organization.

Official Cloudsmith endpoint: POST /orgs/{org}/saml-group-sync/enable/

Enable SAML Group Sync for this organization.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org}/saml-group-sync/enable/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
