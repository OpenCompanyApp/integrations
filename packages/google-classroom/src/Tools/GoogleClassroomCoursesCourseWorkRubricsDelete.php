<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Course Work Rubrics Delete.
 *
 * Maps to the official Google Classroom endpoint DELETE /v1/courses/{courseId}/courseWork/{courseWorkId}/rubrics/{id}.
 */
class GoogleClassroomCoursesCourseWorkRubricsDelete extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_course_work_rubrics_delete';
    protected const DESCRIPTION = 'Courses Course Work Rubrics Delete

Official Google Classroom endpoint: DELETE /v1/courses/{courseId}/courseWork/{courseWorkId}/rubrics/{id}
Deletes a rubric.';
    protected const PARAMETERS = array (
  'courseId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `courseId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
  'courseWorkId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `courseWorkId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/courses/{courseId}/courseWork/{courseWorkId}/rubrics/{id}';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'courseWorkId',
  2 => 'id',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}