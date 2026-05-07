<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Student Groups Delete.
 *
 * Maps to the official Google Classroom endpoint DELETE /v1/courses/{courseId}/studentGroups/{id}.
 */
class GoogleClassroomCoursesStudentGroupsDelete extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_student_groups_delete';
    protected const DESCRIPTION = 'Courses Student Groups Delete

Official Google Classroom endpoint: DELETE /v1/courses/{courseId}/studentGroups/{id}
Deletes a student group.';
    protected const PARAMETERS = array (
  'courseId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `courseId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/courses/{courseId}/studentGroups/{id}';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'id',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}