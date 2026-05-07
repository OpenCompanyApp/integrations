<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Delete a specific OpenID Connect provider setting for the org..
 *
 * Maps to the official Cloudsmith endpoint delete /orgs/{org}/openid-connect/{slug_perm}/.
 */
class CloudsmithOrgsOpenidConnectDelete extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_openid_connect_delete';
    protected const DESCRIPTION = 'Delete a specific OpenID Connect provider setting for the org.

Official Cloudsmith endpoint: DELETE /orgs/{org}/openid-connect/{slug_perm}/

Delete a specific OpenID Connect provider setting for the org.';
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
    protected const PATH = '/orgs/{org}/openid-connect/{slug_perm}/';
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
