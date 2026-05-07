<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Delete a SAML Group Sync mapping from an organization..
 *
 * Maps to the official Cloudsmith endpoint delete /orgs/{org}/saml-group-sync/{slug_perm}/.
 */
class CloudsmithOrgsSamlGroupSyncDelete extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_saml_group_sync_delete';
    protected const DESCRIPTION = 'Delete a SAML Group Sync mapping from an organization.

Official Cloudsmith endpoint: DELETE /orgs/{org}/saml-group-sync/{slug_perm}/

Delete a SAML Group Sync mapping from an organization.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
  'slug_perm' => array (
  'type' => 'string',
  'description' => 'slug_perm parameter.',
  'required' => true,
),
);
    protected const METHOD = 'delete';
    protected const PATH = '/orgs/{org}/saml-group-sync/{slug_perm}/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
  'slug_perm' => 'slug_perm',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
