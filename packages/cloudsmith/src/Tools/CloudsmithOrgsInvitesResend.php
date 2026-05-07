<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Resend an organization invite..
 *
 * Maps to the official Cloudsmith endpoint post /orgs/{org}/invites/{slug_perm}/resend/.
 */
class CloudsmithOrgsInvitesResend extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_invites_resend';
    protected const DESCRIPTION = 'Resend an organization invite.

Official Cloudsmith endpoint: POST /orgs/{org}/invites/{slug_perm}/resend/

Resend an organization invite.';
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
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org}/invites/{slug_perm}/resend/';
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
