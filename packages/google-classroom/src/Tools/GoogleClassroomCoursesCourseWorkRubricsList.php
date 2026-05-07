<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Course Work Rubrics List.
 *
 * Maps to the official Google Classroom endpoint GET /v1/courses/{courseId}/courseWork/{courseWorkId}/rubrics.
 */
class GoogleClassroomCoursesCourseWorkRubricsList extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_course_work_rubrics_list';
    protected const DESCRIPTION = 'Courses Course Work Rubrics List

Official Google Classroom endpoint: GET /v1/courses/{courseId}/courseWork/{courseWorkId}/rubrics
Returns a list of rubrics that the requester is permitted to view.';
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
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: pageToken, pageSize.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/courses/{courseId}/courseWork/{courseWorkId}/rubrics';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'courseWorkId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
}