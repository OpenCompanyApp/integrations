<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get the details for the specific organization..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/.
 */
class CloudsmithOrgsRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_read';
    protected const DESCRIPTION = 'Get the details for the specific organization.

Official Cloudsmith endpoint: GET /orgs/{org}/

Get the details for the specific organization.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org}/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
