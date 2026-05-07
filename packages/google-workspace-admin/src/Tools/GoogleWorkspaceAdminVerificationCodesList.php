<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Verification Codes List.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/users/{userKey}/verificationCodes.
 */
class GoogleWorkspaceAdminVerificationCodesList extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_verification_codes_list';
    protected const DESCRIPTION = 'Verification Codes List

Official Workspace Admin endpoint: GET /admin/directory/v1/users/{userKey}/verificationCodes
Returns the current set of valid backup verification codes for the specified user.';
    protected const PARAMETERS = array (
  'userKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/users/{userKey}/verificationCodes';
    protected const PATH_PARAMS = array (
  0 => 'userKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}