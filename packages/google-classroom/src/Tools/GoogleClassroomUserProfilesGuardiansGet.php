<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * User Profiles Guardians Get.
 *
 * Maps to the official Google Classroom endpoint GET /v1/userProfiles/{studentId}/guardians/{guardianId}.
 */
class GoogleClassroomUserProfilesGuardiansGet extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_user_profiles_guardians_get';
    protected const DESCRIPTION = 'User Profiles Guardians Get

Official Google Classroom endpoint: GET /v1/userProfiles/{studentId}/guardians/{guardianId}
Returns a specific guardian.';
    protected const PARAMETERS = array (
  'studentId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `studentId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
  'guardianId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `guardianId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/userProfiles/{studentId}/guardians/{guardianId}';
    protected const PATH_PARAMS = array (
  0 => 'studentId',
  1 => 'guardianId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}