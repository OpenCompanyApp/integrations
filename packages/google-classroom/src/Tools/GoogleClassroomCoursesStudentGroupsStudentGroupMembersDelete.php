<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Student Groups Student Group Members Delete.
 *
 * Maps to the official Google Classroom endpoint DELETE /v1/courses/{courseId}/studentGroups/{studentGroupId}/studentGroupMembers/{userId}.
 */
class GoogleClassroomCoursesStudentGroupsStudentGroupMembersDelete extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_student_groups_student_group_members_delete';
    protected const DESCRIPTION = 'Courses Student Groups Student Group Members Delete

Official Google Classroom endpoint: DELETE /v1/courses/{courseId}/studentGroups/{studentGroupId}/studentGroupMembers/{userId}
Deletes a student group member.';
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
  'userId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/courses/{courseId}/studentGroups/{studentGroupId}/studentGroupMembers/{userId}';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'studentGroupId',
  2 => 'userId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}