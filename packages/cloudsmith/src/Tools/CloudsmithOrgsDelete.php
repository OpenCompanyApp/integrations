<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Delete the specified organization..
 *
 * Maps to the official Cloudsmith endpoint delete /orgs/{org}/.
 */
class CloudsmithOrgsDelete extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_delete';
    protected const DESCRIPTION = 'Delete the specified organization.

Official Cloudsmith endpoint: DELETE /orgs/{org}/

Delete the specified organization.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
);
    protected const METHOD = 'delete';
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
