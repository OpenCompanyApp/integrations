<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Update a member's role in the organization..
 *
 * Maps to the official Cloudsmith endpoint patch /orgs/{org}/members/{member}/update-role/.
 */
class CloudsmithOrgsMembersUpdateRole extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_members_update_role';
    protected const DESCRIPTION = 'Update a member\'s role in the organization.

Official Cloudsmith endpoint: PATCH /orgs/{org}/members/{member}/update-role/

Update a member\'s role in the organization.';
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
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'patch';
    protected const PATH = '/orgs/{org}/members/{member}/update-role/';
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
