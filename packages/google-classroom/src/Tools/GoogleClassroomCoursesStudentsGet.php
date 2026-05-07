<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Students Get.
 *
 * Maps to the official Google Classroom endpoint GET /v1/courses/{courseId}/students/{userId}.
 */
class GoogleClassroomCoursesStudentsGet extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_students_get';
    protected const DESCRIPTION = 'Courses Students Get

Official Google Classroom endpoint: GET /v1/courses/{courseId}/students/{userId}
Returns a student of a course.';
    protected const PARAMETERS = array (
  'courseId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `courseId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
  'userId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/courses/{courseId}/students/{userId}';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'userId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}