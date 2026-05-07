<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * User Profiles Guardian Invitations Patch.
 *
 * Maps to the official Google Classroom endpoint PATCH /v1/userProfiles/{studentId}/guardianInvitations/{invitationId}.
 */
class GoogleClassroomUserProfilesGuardianInvitationsPatch extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_user_profiles_guardian_invitations_patch';
    protected const DESCRIPTION = 'User Profiles Guardian Invitations Patch

Official Google Classroom endpoint: PATCH /v1/userProfiles/{studentId}/guardianInvitations/{invitationId}
Modifies a guardian invitation.';
    protected const PARAMETERS = array (
  'studentId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `studentId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
  'invitationId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `invitationId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: updateMask.',
  ),
  'updateMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `updateMask`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Classroom `GuardianInvitation` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/userProfiles/{studentId}/guardianInvitations/{invitationId}';
    protected const PATH_PARAMS = array (
  0 => 'studentId',
  1 => 'invitationId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'updateMask',
);
    protected const BODY_REQUIRED = true;
}