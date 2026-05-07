<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Create the OpenID Connect provider settings for the org..
 *
 * Maps to the official Cloudsmith endpoint post /orgs/{org}/openid-connect/.
 */
class CloudsmithOrgsOpenidConnectCreate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_openid_connect_create';
    protected const DESCRIPTION = 'Create the OpenID Connect provider settings for the org.

Official Cloudsmith endpoint: POST /orgs/{org}/openid-connect/

Create the OpenID Connect provider settings for the org.';
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
    protected const PATH = '/orgs/{org}/openid-connect/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
