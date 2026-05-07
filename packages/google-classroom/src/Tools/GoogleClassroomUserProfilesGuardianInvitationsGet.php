<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * User Profiles Guardian Invitations Get.
 *
 * Maps to the official Google Classroom endpoint GET /v1/userProfiles/{studentId}/guardianInvitations/{invitationId}.
 */
class GoogleClassroomUserProfilesGuardianInvitationsGet extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_user_profiles_guardian_invitations_get';
    protected const DESCRIPTION = 'User Profiles Guardian Invitations Get

Official Google Classroom endpoint: GET /v1/userProfiles/{studentId}/guardianInvitations/{invitationId}
Returns a specific guardian invitation.';
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/userProfiles/{studentId}/guardianInvitations/{invitationId}';
    protected const PATH_PARAMS = array (
  0 => 'studentId',
  1 => 'invitationId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}