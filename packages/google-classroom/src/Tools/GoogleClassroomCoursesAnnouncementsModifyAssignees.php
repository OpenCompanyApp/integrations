<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Announcements Modify Assignees.
 *
 * Maps to the official Google Classroom endpoint POST /v1/courses/{courseId}/announcements/{id}:modifyAssignees.
 */
class GoogleClassroomCoursesAnnouncementsModifyAssignees extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_announcements_modify_assignees';
    protected const DESCRIPTION = 'Courses Announcements Modify Assignees

Official Google Classroom endpoint: POST /v1/courses/{courseId}/announcements/{id}:modifyAssignees
Modifies assignee mode and options of an announcement.';
    protected const PARAMETERS = array (
  'courseId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `courseId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Classroom `ModifyAnnouncementAssigneesRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/courses/{courseId}/announcements/{id}:modifyAssignees';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'id',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}