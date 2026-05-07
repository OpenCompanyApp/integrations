<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Create.
 *
 * Maps to the official Google Classroom endpoint POST /v1/courses.
 */
class GoogleClassroomCoursesCreate extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_create';
    protected const DESCRIPTION = 'Courses Create

Official Google Classroom endpoint: POST /v1/courses
Creates a course.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Classroom `Course` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/courses';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}