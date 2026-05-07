<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Retrieve a specific OpenID Connect dynamic mapping for the provider setting..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/openid-connect/{provider_setting}/dynamic-mappings/{claim_value}/.
 */
class CloudsmithOrgsOpenidConnectDynamicMappingsRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_openid_connect_dynamic_mappings_read';
    protected const DESCRIPTION = 'Retrieve a specific OpenID Connect dynamic mapping for the provider setting.

Official Cloudsmith endpoint: GET /orgs/{org}/openid-connect/{provider_setting}/dynamic-mappings/{claim_value}/

Retrieve a specific OpenID Connect dynamic mapping for the provider setting.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
  'provider_setting' => array (
  'type' => 'string',
  'description' => 'provider_setting parameter.',
  'required' => true,
),
  'claim_value' => array (
  'type' => 'string',
  'description' => 'claim_value parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org}/openid-connect/{provider_setting}/dynamic-mappings/{claim_value}/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
  'provider_setting' => 'provider_setting',
  'claim_value' => 'claim_value',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
