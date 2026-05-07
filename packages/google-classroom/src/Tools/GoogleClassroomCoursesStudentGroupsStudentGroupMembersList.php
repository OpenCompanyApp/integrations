<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Student Groups Student Group Members List.
 *
 * Maps to the official Google Classroom endpoint GET /v1/courses/{courseId}/studentGroups/{studentGroupId}/studentGroupMembers.
 */
class GoogleClassroomCoursesStudentGroupsStudentGroupMembersList extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_student_groups_student_group_members_list';
    protected const DESCRIPTION = 'Courses Student Groups Student Group Members List

Official Google Classroom endpoint: GET /v1/courses/{courseId}/studentGroups/{studentGroupId}/studentGroupMembers
Returns a list of students in a group.';
    protected const PARAMETERS = array (
  'courseId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `courseId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
  'studentGroupId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `studentGroupId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
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
    protected const PATH = '/v1/courses/{courseId}/studentGroups/{studentGroupId}/studentGroupMembers';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'studentGroupId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
}