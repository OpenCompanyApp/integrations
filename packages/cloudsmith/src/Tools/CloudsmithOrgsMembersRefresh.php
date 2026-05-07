<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Refresh a member of the organization's API key..
 *
 * Maps to the official Cloudsmith endpoint post /orgs/{org}/members/{member}/refresh/.
 */
class CloudsmithOrgsMembersRefresh extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_members_refresh';
    protected const DESCRIPTION = 'Refresh a member of the organization\'s API key.

Official Cloudsmith endpoint: POST /orgs/{org}/members/{member}/refresh/

Refresh a member of the organization\'s API key.';
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
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org}/members/{member}/refresh/';
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
