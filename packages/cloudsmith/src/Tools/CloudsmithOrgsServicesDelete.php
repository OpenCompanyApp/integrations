<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Delete a specific service.
 *
 * Maps to the official Cloudsmith endpoint delete /orgs/{org}/services/{service}/.
 */
class CloudsmithOrgsServicesDelete extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_services_delete';
    protected const DESCRIPTION = 'Delete a specific service

Official Cloudsmith endpoint: DELETE /orgs/{org}/services/{service}/

Delete a specific service';
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
    protected const METHOD = 'delete';
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
