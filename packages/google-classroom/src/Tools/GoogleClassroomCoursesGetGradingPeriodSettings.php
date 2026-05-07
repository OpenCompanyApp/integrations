<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Get Grading Period Settings.
 *
 * Maps to the official Google Classroom endpoint GET /v1/courses/{courseId}/gradingPeriodSettings.
 */
class GoogleClassroomCoursesGetGradingPeriodSettings extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_get_grading_period_settings';
    protected const DESCRIPTION = 'Courses Get Grading Period Settings

Official Google Classroom endpoint: GET /v1/courses/{courseId}/gradingPeriodSettings
Returns the grading period settings in a course.';
    protected const PARAMETERS = array (
  'courseId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `courseId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/courses/{courseId}/gradingPeriodSettings';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}