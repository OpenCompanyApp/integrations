<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Create a service within an organization..
 *
 * Maps to the official Cloudsmith endpoint post /orgs/{org}/services/.
 */
class CloudsmithOrgsServicesCreate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_services_create';
    protected const DESCRIPTION = 'Create a service within an organization.

Official Cloudsmith endpoint: POST /orgs/{org}/services/

Create a service within an organization.';
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
    protected const PATH = '/orgs/{org}/services/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
