<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Aliases Delete.
 *
 * Maps to the official Google Classroom endpoint DELETE /v1/courses/{courseId}/aliases/{alias}.
 */
class GoogleClassroomCoursesAliasesDelete extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_aliases_delete';
    protected const DESCRIPTION = 'Courses Aliases Delete

Official Google Classroom endpoint: DELETE /v1/courses/{courseId}/aliases/{alias}
Deletes an alias of a course.';
    protected const PARAMETERS = array (
  'courseId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `courseId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
  'alias' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `alias`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/courses/{courseId}/aliases/{alias}';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'alias',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}