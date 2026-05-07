<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Create an organization invite for a specific user.
 *
 * Maps to the official Cloudsmith endpoint post /orgs/{org}/invites/.
 */
class CloudsmithOrgsInvitesCreate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_invites_create';
    protected const DESCRIPTION = 'Create an organization invite for a specific user

Official Cloudsmith endpoint: POST /orgs/{org}/invites/

Create an organization invite for a specific user';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org}/invites/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
