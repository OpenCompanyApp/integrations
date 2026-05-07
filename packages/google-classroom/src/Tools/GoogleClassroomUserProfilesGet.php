<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * User Profiles Get.
 *
 * Maps to the official Google Classroom endpoint GET /v1/userProfiles/{userId}.
 */
class GoogleClassroomUserProfilesGet extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_user_profiles_get';
    protected const DESCRIPTION = 'User Profiles Get

Official Google Classroom endpoint: GET /v1/userProfiles/{userId}
Returns a user profile.';
    protected const PARAMETERS = array (
  'userId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/userProfiles/{userId}';
    protected const PATH_PARAMS = array (
  0 => 'userId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}