<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Removes a member from the organization..
 *
 * Maps to the official Cloudsmith endpoint delete /orgs/{org}/members/{member}/.
 */
class CloudsmithOrgsMembersDelete extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_members_delete';
    protected const DESCRIPTION = 'Removes a member from the organization.

Official Cloudsmith endpoint: DELETE /orgs/{org}/members/{member}/

Removes a member from the organization.';
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
    protected const METHOD = 'delete';
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
