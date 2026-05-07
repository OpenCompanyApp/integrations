<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Update Grading Period Settings.
 *
 * Maps to the official Google Classroom endpoint PATCH /v1/courses/{courseId}/gradingPeriodSettings.
 */
class GoogleClassroomCoursesUpdateGradingPeriodSettings extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_update_grading_period_settings';
    protected const DESCRIPTION = 'Courses Update Grading Period Settings

Official Google Classroom endpoint: PATCH /v1/courses/{courseId}/gradingPeriodSettings
Updates grading period settings of a course.';
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
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: updateMask.',
  ),
  'updateMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `updateMask`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Classroom `GradingPeriodSettings` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/courses/{courseId}/gradingPeriodSettings';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'updateMask',
);
    protected const BODY_REQUIRED = true;
}