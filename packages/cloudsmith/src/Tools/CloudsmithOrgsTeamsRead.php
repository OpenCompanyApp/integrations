<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get the details of a specific team within an organization..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/teams/{team}/.
 */
class CloudsmithOrgsTeamsRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_teams_read';
    protected const DESCRIPTION = 'Get the details of a specific team within an organization.

Official Cloudsmith endpoint: GET /orgs/{org}/teams/{team}/

Get the details of a specific team within an organization.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org}/teams/{team}/';
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
