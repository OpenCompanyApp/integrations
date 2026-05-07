<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Update a service within an organization..
 *
 * Maps to the official Cloudsmith endpoint patch /orgs/{org}/services/{service}/.
 */
class CloudsmithOrgsServicesPartialUpdate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_services_partial_update';
    protected const DESCRIPTION = 'Update a service within an organization.

Official Cloudsmith endpoint: PATCH /orgs/{org}/services/{service}/

Update a service within an organization.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
  'service' => array (
  'type' => 'string',
  'description' => 'service parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'patch';
    protected const PATH = '/orgs/{org}/services/{service}/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
  'service' => 'service',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
