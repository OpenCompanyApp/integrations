<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Delete.
 *
 * Maps to the official Google Classroom endpoint DELETE /v1/courses/{id}.
 */
class GoogleClassroomCoursesDelete extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_delete';
    protected const DESCRIPTION = 'Courses Delete

Official Google Classroom endpoint: DELETE /v1/courses/{id}
Deletes a course.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/courses/{id}';
    protected const PATH_PARAMS = array (
  0 => 'id',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}