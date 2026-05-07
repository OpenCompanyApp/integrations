<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Removes a member from the organization (deprecated, use DELETE instead)..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/members/{member}/remove/.
 */
class CloudsmithOrgsMembersRemove extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_members_remove';
    protected const DESCRIPTION = 'Removes a member from the organization (deprecated, use DELETE instead).

Official Cloudsmith endpoint: GET /orgs/{org}/members/{member}/remove/

Removes a member from the organization (deprecated, use DELETE instead).';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
  'member' => array (
  'type' => 'string',
  'description' => 'member parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org}/members/{member}/remove/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
  'member' => 'member',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
