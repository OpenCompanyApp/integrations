<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get the details for a specific organization member..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/members/{member}/.
 */
class CloudsmithOrgsMembersRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_members_read';
    protected const DESCRIPTION = 'Get the details for a specific organization member.

Official Cloudsmith endpoint: GET /orgs/{org}/members/{member}/

Get the details for a specific organization member.';
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
    protected const PATH = '/orgs/{org}/members/{member}/';
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
