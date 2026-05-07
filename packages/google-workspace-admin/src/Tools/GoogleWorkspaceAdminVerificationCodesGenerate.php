<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Verification Codes Generate.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/users/{userKey}/verificationCodes/generate.
 */
class GoogleWorkspaceAdminVerificationCodesGenerate extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_verification_codes_generate';
    protected const DESCRIPTION = 'Verification Codes Generate

Official Workspace Admin endpoint: POST /admin/directory/v1/users/{userKey}/verificationCodes/generate
Generates new backup verification codes for the user.';
    protected const PARAMETERS = array (
  'userKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/users/{userKey}/verificationCodes/generate';
    protected const PATH_PARAMS = array (
  0 => 'userKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}