<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses List.
 *
 * Maps to the official Google Classroom endpoint GET /v1/courses.
 */
class GoogleClassroomCoursesList extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_list';
    protected const DESCRIPTION = 'Courses List

Official Google Classroom endpoint: GET /v1/courses
Returns a list of courses that the requesting user is permitted to view, restricted to those that match the request.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: teacherId, pageSize, studentId, courseStates, pageToken.',
  ),
  'teacherId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `teacherId`.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'studentId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `studentId`.',
  ),
  'courseStates' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `courseStates`.',
    'enum' =>
    array (
      0 => 'COURSE_STATE_UNSPECIFIED',
      1 => 'ACTIVE',
      2 => 'ARCHIVED',
      3 => 'PROVISIONED',
      4 => 'DECLINED',
      5 => 'SUSPENDED',
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
    protected const PATH = '/v1/courses';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'teacherId',
  1 => 'pageSize',
  2 => 'studentId',
  3 => 'courseStates',
  4 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}