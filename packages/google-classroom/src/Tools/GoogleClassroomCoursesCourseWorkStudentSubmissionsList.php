<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Course Work Student Submissions List.
 *
 * Maps to the official Google Classroom endpoint GET /v1/courses/{courseId}/courseWork/{courseWorkId}/studentSubmissions.
 */
class GoogleClassroomCoursesCourseWorkStudentSubmissionsList extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_course_work_student_submissions_list';
    protected const DESCRIPTION = 'Courses Course Work Student Submissions List

Official Google Classroom endpoint: GET /v1/courses/{courseId}/courseWork/{courseWorkId}/studentSubmissions
Returns a list of student submissions that the requester is permitted to view, factoring in the OAuth scopes of the request.';
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
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: userId, late, pageSize, states, pageToken.',
  ),
  'userId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userId`.',
  ),
  'late' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `late`.',
    'enum' =>
    array (
      0 => 'LATE_VALUES_UNSPECIFIED',
      1 => 'LATE_ONLY',
      2 => 'NOT_LATE_ONLY',
    ),
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'states' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `states`.',
    'enum' =>
    array (
      0 => 'SUBMISSION_STATE_UNSPECIFIED',
      1 => 'NEW',
      2 => 'CREATED',
      3 => 'TURNED_IN',
      4 => 'RETURNED',
      5 => 'RECLAIMED_BY_STUDENT',
    ),
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/courses/{courseId}/courseWork/{courseWorkId}/studentSubmissions';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'courseWorkId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'userId',
  1 => 'late',
  2 => 'pageSize',
  3 => 'states',
  4 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}