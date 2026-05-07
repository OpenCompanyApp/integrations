<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Get.
 *
 * Maps to the official Google Classroom endpoint GET /v1/courses/{id}.
 */
class GoogleClassroomCoursesGet extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_get';
    protected const DESCRIPTION = 'Courses Get

Official Google Classroom endpoint: GET /v1/courses/{id}
Returns a course.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/courses/{id}';
    protected const PATH_PARAMS = array (
  0 => 'id',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}