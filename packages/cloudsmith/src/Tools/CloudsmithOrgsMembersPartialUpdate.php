<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Views for working with organization members..
 *
 * Maps to the official Cloudsmith endpoint patch /orgs/{org}/members/{member}/.
 */
class CloudsmithOrgsMembersPartialUpdate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_members_partial_update';
    protected const DESCRIPTION = 'Views for working with organization members.

Official Cloudsmith endpoint: PATCH /orgs/{org}/members/{member}/

Views for working with organization members.';
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
