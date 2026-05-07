<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a list of all invites for an organization..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/invites/.
 */
class CloudsmithOrgsInvitesList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_invites_list';
    protected const DESCRIPTION = 'Get a list of all invites for an organization.

Official Cloudsmith endpoint: GET /orgs/{org}/invites/

Get a list of all invites for an organization.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
  'page' => array (
  'type' => 'string',
  'description' => 'A page number within the paginated result set.',
),
  'page_size' => array (
  'type' => 'string',
  'description' => 'Number of results to return per page.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org}/invites/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
