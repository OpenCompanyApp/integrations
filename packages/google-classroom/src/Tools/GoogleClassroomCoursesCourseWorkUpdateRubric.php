<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Course Work Update Rubric.
 *
 * Maps to the official Google Classroom endpoint PATCH /v1/courses/{courseId}/courseWork/{courseWorkId}/rubric.
 */
class GoogleClassroomCoursesCourseWorkUpdateRubric extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_course_work_update_rubric';
    protected const DESCRIPTION = 'Courses Course Work Update Rubric

Official Google Classroom endpoint: PATCH /v1/courses/{courseId}/courseWork/{courseWorkId}/rubric
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
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: id, updateMask.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `id`.',
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
    protected const PATH = '/v1/courses/{courseId}/courseWork/{courseWorkId}/rubric';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'courseWorkId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'id',
  1 => 'updateMask',
);
    protected const BODY_REQUIRED = true;
}