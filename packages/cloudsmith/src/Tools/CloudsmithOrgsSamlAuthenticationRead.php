<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Retrieve the SAML Authentication settings for this Organization..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/saml-authentication.
 */
class CloudsmithOrgsSamlAuthenticationRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_saml_authentication_read';
    protected const DESCRIPTION = 'Retrieve the SAML Authentication settings for this Organization.

Official Cloudsmith endpoint: GET /orgs/{org}/saml-authentication

Retrieve the SAML Authentication settings for this Organization.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org}/saml-authentication';
    protected const PATH_PARAMS = array (
  'org' => 'org',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
