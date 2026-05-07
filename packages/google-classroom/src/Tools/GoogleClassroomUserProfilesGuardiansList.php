<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * User Profiles Guardians List.
 *
 * Maps to the official Google Classroom endpoint GET /v1/userProfiles/{studentId}/guardians.
 */
class GoogleClassroomUserProfilesGuardiansList extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_user_profiles_guardians_list';
    protected const DESCRIPTION = 'User Profiles Guardians List

Official Google Classroom endpoint: GET /v1/userProfiles/{studentId}/guardians
Returns a list of guardians that the requesting user is permitted to view, restricted to those that match the request.';
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
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: pageToken, invitedEmailAddress, pageSize.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/userProfiles/{studentId}/guardians';
    protected const PATH_PARAMS = array (
  0 => 'studentId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'invitedEmailAddress',
  2 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
}