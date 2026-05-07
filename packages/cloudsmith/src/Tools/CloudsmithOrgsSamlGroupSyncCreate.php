<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Create a new SAML Group Sync mapping within an organization..
 *
 * Maps to the official Cloudsmith endpoint post /orgs/{org}/saml-group-sync/.
 */
class CloudsmithOrgsSamlGroupSyncCreate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_saml_group_sync_create';
    protected const DESCRIPTION = 'Create a new SAML Group Sync mapping within an organization.

Official Cloudsmith endpoint: POST /orgs/{org}/saml-group-sync/

Create a new SAML Group Sync mapping within an organization.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org}/saml-group-sync/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
