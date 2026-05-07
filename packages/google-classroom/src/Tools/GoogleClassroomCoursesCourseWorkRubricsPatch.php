<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Course Work Rubrics Patch.
 *
 * Maps to the official Google Classroom endpoint PATCH /v1/courses/{courseId}/courseWork/{courseWorkId}/rubrics/{id}.
 */
class GoogleClassroomCoursesCourseWorkRubricsPatch extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_course_work_rubrics_patch';
    protected const DESCRIPTION = 'Courses Course Work Rubrics Patch

Official Google Classroom endpoint: PATCH /v1/courses/{courseId}/courseWork/{courseWorkId}/rubrics/{id}
Updates a rubric.';
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
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: updateMask.',
  ),
  'updateMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `updateMask`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Classroom `Rubric` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/courses/{courseId}/courseWork/{courseWorkId}/rubrics/{id}';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'courseWorkId',
  2 => 'id',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'updateMask',
);
    protected const BODY_REQUIRED = true;
}