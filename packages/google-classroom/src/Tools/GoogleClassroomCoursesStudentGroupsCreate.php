<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Student Groups Create.
 *
 * Maps to the official Google Classroom endpoint POST /v1/courses/{courseId}/studentGroups.
 */
class GoogleClassroomCoursesStudentGroupsCreate extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_student_groups_create';
    protected const DESCRIPTION = 'Courses Student Groups Create

Official Google Classroom endpoint: POST /v1/courses/{courseId}/studentGroups
Creates a student group for a course.';
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
    'description' => 'JSON request body matching the official Google Classroom `StudentGroup` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/courses/{courseId}/studentGroups';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}