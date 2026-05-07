<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Course Work Student Submissions Return.
 *
 * Maps to the official Google Classroom endpoint POST /v1/courses/{courseId}/courseWork/{courseWorkId}/studentSubmissions/{id}:return.
 */
class GoogleClassroomCoursesCourseWorkStudentSubmissionsReturn extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_course_work_student_submissions_return';
    protected const DESCRIPTION = 'Courses Course Work Student Submissions Return

Official Google Classroom endpoint: POST /v1/courses/{courseId}/courseWork/{courseWorkId}/studentSubmissions/{id}:return
Returns a student submission.';
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
    'description' => 'JSON request body matching the official Google Classroom `ReturnStudentSubmissionRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/courses/{courseId}/courseWork/{courseWorkId}/studentSubmissions/{id}:return';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'courseWorkId',
  2 => 'id',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}