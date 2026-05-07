<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Announcements Create.
 *
 * Maps to the official Google Classroom endpoint POST /v1/courses/{courseId}/announcements.
 */
class GoogleClassroomCoursesAnnouncementsCreate extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_announcements_create';
    protected const DESCRIPTION = 'Courses Announcements Create

Official Google Classroom endpoint: POST /v1/courses/{courseId}/announcements
Creates an announcement.';
    protected const PARAMETERS = array (
  'courseId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `courseId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Classroom `Announcement` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/courses/{courseId}/announcements';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}