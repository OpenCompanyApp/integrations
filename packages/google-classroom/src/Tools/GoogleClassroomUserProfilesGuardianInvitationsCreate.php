<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * User Profiles Guardian Invitations Create.
 *
 * Maps to the official Google Classroom endpoint POST /v1/userProfiles/{studentId}/guardianInvitations.
 */
class GoogleClassroomUserProfilesGuardianInvitationsCreate extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_user_profiles_guardian_invitations_create';
    protected const DESCRIPTION = 'User Profiles Guardian Invitations Create

Official Google Classroom endpoint: POST /v1/userProfiles/{studentId}/guardianInvitations
Creates a guardian invitation, and sends an email to the guardian asking them to confirm that they are the student\'s guardian.';
    protected const PARAMETERS = array (
  'studentId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `studentId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Classroom `GuardianInvitation` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/userProfiles/{studentId}/guardianInvitations';
    protected const PATH_PARAMS = array (
  0 => 'studentId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}