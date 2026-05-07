<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * User Profiles Guardian Invitations List.
 *
 * Maps to the official Google Classroom endpoint GET /v1/userProfiles/{studentId}/guardianInvitations.
 */
class GoogleClassroomUserProfilesGuardianInvitationsList extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_user_profiles_guardian_invitations_list';
    protected const DESCRIPTION = 'User Profiles Guardian Invitations List

Official Google Classroom endpoint: GET /v1/userProfiles/{studentId}/guardianInvitations
Returns a list of guardian invitations that the requesting user is permitted to view, filtered by the parameters provided.';
    protected const PARAMETERS = array (
  'studentId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `studentId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: states, invitedEmailAddress, pageSize, pageToken.',
  ),
  'states' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `states`.',
    'enum' =>
    array (
      0 => 'GUARDIAN_INVITATION_STATE_UNSPECIFIED',
      1 => 'PENDING',
      2 => 'COMPLETE',
    ),
  ),
  'invitedEmailAddress' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `invitedEmailAddress`.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/userProfiles/{studentId}/guardianInvitations';
    protected const PATH_PARAMS = array (
  0 => 'studentId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'states',
  1 => 'invitedEmailAddress',
  2 => 'pageSize',
  3 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}