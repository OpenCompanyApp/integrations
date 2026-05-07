<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Retrieve a specific OpenID Connect provider setting for the org..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/openid-connect/{slug_perm}/.
 */
class CloudsmithOrgsOpenidConnectRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_openid_connect_read';
    protected const DESCRIPTION = 'Retrieve a specific OpenID Connect provider setting for the org.

Official Cloudsmith endpoint: GET /orgs/{org}/openid-connect/{slug_perm}/

Retrieve a specific OpenID Connect provider setting for the org.';
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
    protected const METHOD = 'get';
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
