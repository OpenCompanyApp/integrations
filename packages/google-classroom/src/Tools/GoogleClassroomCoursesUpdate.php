<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Update.
 *
 * Maps to the official Google Classroom endpoint PUT /v1/courses/{id}.
 */
class GoogleClassroomCoursesUpdate extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_update';
    protected const DESCRIPTION = 'Courses Update

Official Google Classroom endpoint: PUT /v1/courses/{id}
Updates a course.';
    protected const PARAMETERS = array (
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
    'description' => 'JSON request body matching the official Google Classroom `Course` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/courses/{id}';
    protected const PATH_PARAMS = array (
  0 => 'id',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}