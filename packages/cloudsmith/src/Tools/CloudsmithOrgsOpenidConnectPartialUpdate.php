<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Update a specific OpenID Connect provider setting for the org..
 *
 * Maps to the official Cloudsmith endpoint patch /orgs/{org}/openid-connect/{slug_perm}/.
 */
class CloudsmithOrgsOpenidConnectPartialUpdate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_openid_connect_partial_update';
    protected const DESCRIPTION = 'Update a specific OpenID Connect provider setting for the org.

Official Cloudsmith endpoint: PATCH /orgs/{org}/openid-connect/{slug_perm}/

Update a specific OpenID Connect provider setting for the org.';
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
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'patch';
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
