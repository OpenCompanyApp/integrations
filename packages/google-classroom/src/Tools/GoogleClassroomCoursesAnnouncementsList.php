<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Announcements List.
 *
 * Maps to the official Google Classroom endpoint GET /v1/courses/{courseId}/announcements.
 */
class GoogleClassroomCoursesAnnouncementsList extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_announcements_list';
    protected const DESCRIPTION = 'Courses Announcements List

Official Google Classroom endpoint: GET /v1/courses/{courseId}/announcements
Returns a list of announcements that the requester is permitted to view.';
    protected const PARAMETERS = array (
  'courseId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `courseId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: announcementStates, pageToken, pageSize, orderBy.',
  ),
  'announcementStates' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `announcementStates`.',
    'enum' =>
    array (
      0 => 'ANNOUNCEMENT_STATE_UNSPECIFIED',
      1 => 'PUBLISHED',
      2 => 'DRAFT',
      3 => 'DELETED',
    ),
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
  'orderBy' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orderBy`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/courses/{courseId}/announcements';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'announcementStates',
  1 => 'pageToken',
  2 => 'pageSize',
  3 => 'orderBy',
);
    protected const BODY_REQUIRED = false;
}