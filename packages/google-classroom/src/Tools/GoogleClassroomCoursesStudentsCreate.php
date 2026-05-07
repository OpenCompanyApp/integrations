<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Students Create.
 *
 * Maps to the official Google Classroom endpoint POST /v1/courses/{courseId}/students.
 */
class GoogleClassroomCoursesStudentsCreate extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_students_create';
    protected const DESCRIPTION = 'Courses Students Create

Official Google Classroom endpoint: POST /v1/courses/{courseId}/students
Adds a user as a student of a course.';
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
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: enrollmentCode.',
  ),
  'enrollmentCode' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `enrollmentCode`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Classroom `Student` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/courses/{courseId}/students';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'enrollmentCode',
);
    protected const BODY_REQUIRED = true;
}