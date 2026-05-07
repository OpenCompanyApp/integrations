<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Two Step Verification Turn Off.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/users/{userKey}/twoStepVerification/turnOff.
 */
class GoogleWorkspaceAdminTwoStepVerificationTurnOff extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_two_step_verification_turn_off';
    protected const DESCRIPTION = 'Two Step Verification Turn Off

Official Workspace Admin endpoint: POST /admin/directory/v1/users/{userKey}/twoStepVerification/turnOff
Turns off 2-Step Verification for user.';
    protected const PARAMETERS = array (
  'userKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/users/{userKey}/twoStepVerification/turnOff';
    protected const PATH_PARAMS = array (
  0 => 'userKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}