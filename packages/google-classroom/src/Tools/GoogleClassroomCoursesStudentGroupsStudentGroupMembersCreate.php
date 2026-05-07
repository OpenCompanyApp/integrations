<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Student Groups Student Group Members Create.
 *
 * Maps to the official Google Classroom endpoint POST /v1/courses/{courseId}/studentGroups/{studentGroupId}/studentGroupMembers.
 */
class GoogleClassroomCoursesStudentGroupsStudentGroupMembersCreate extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_student_groups_student_group_members_create';
    protected const DESCRIPTION = 'Courses Student Groups Student Group Members Create

Official Google Classroom endpoint: POST /v1/courses/{courseId}/studentGroups/{studentGroupId}/studentGroupMembers
Creates a student group member for a student group.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Classroom `StudentGroupMember` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/courses/{courseId}/studentGroups/{studentGroupId}/studentGroupMembers';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'studentGroupId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}