<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Update the SAML Authentication settings for this Organization..
 *
 * Maps to the official Cloudsmith endpoint patch /orgs/{org}/saml-authentication.
 */
class CloudsmithOrgsSamlAuthenticationPartialUpdate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_saml_authentication_partial_update';
    protected const DESCRIPTION = 'Update the SAML Authentication settings for this Organization.

Official Cloudsmith endpoint: PATCH /orgs/{org}/saml-authentication

Update the SAML Authentication settings for this Organization.';
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
    protected const METHOD = 'patch';
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
