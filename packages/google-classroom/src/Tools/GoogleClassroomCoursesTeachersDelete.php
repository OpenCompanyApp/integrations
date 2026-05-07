<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Teachers Delete.
 *
 * Maps to the official Google Classroom endpoint DELETE /v1/courses/{courseId}/teachers/{userId}.
 */
class GoogleClassroomCoursesTeachersDelete extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_teachers_delete';
    protected const DESCRIPTION = 'Courses Teachers Delete

Official Google Classroom endpoint: DELETE /v1/courses/{courseId}/teachers/{userId}
Removes the specified teacher from the specified course.';
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
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/courses/{courseId}/teachers/{userId}';
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