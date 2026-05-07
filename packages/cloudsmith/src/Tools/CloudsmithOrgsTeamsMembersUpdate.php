<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Replace all team members..
 *
 * Maps to the official Cloudsmith endpoint put /orgs/{org}/teams/{team}/members.
 */
class CloudsmithOrgsTeamsMembersUpdate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_teams_members_update';
    protected const DESCRIPTION = 'Replace all team members.

Official Cloudsmith endpoint: PUT /orgs/{org}/teams/{team}/members

Replace all team members.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
  'team' => array (
  'type' => 'string',
  'description' => 'team parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'put';
    protected const PATH = '/orgs/{org}/teams/{team}/members';
    protected const PATH_PARAMS = array (
  'org' => 'org',
  'team' => 'team',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
