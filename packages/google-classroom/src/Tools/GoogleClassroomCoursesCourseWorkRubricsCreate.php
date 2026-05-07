<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Course Work Rubrics Create.
 *
 * Maps to the official Google Classroom endpoint POST /v1/courses/{courseId}/courseWork/{courseWorkId}/rubrics.
 */
class GoogleClassroomCoursesCourseWorkRubricsCreate extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_course_work_rubrics_create';
    protected const DESCRIPTION = 'Courses Course Work Rubrics Create

Official Google Classroom endpoint: POST /v1/courses/{courseId}/courseWork/{courseWorkId}/rubrics
Creates a rubric.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Classroom `Rubric` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/courses/{courseId}/courseWork/{courseWorkId}/rubrics';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'courseWorkId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}