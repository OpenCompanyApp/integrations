<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Retrieve details of a single service within an organization..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/services/{service}/.
 */
class CloudsmithOrgsServicesRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_services_read';
    protected const DESCRIPTION = 'Retrieve details of a single service within an organization.

Official Cloudsmith endpoint: GET /orgs/{org}/services/{service}/

Retrieve details of a single service within an organization.';
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
);
    protected const METHOD = 'get';
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
