<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Update a specific organization invite..
 *
 * Maps to the official Cloudsmith endpoint patch /orgs/{org}/invites/{slug_perm}/.
 */
class CloudsmithOrgsInvitesPartialUpdate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_invites_partial_update';
    protected const DESCRIPTION = 'Update a specific organization invite.

Official Cloudsmith endpoint: PATCH /orgs/{org}/invites/{slug_perm}/

Update a specific organization invite.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
  'slug_perm' => array (
  'type' => 'string',
  'description' => 'slug_perm parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'patch';
    protected const PATH = '/orgs/{org}/invites/{slug_perm}/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
  'slug_perm' => 'slug_perm',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
