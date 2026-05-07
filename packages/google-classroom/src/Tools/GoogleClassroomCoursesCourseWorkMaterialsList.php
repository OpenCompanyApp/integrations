<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Course Work Materials List.
 *
 * Maps to the official Google Classroom endpoint GET /v1/courses/{courseId}/courseWorkMaterials.
 */
class GoogleClassroomCoursesCourseWorkMaterialsList extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_course_work_materials_list';
    protected const DESCRIPTION = 'Courses Course Work Materials List

Official Google Classroom endpoint: GET /v1/courses/{courseId}/courseWorkMaterials
Returns a list of course work material that the requester is permitted to view.';
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
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: materialDriveId, pageToken, pageSize, courseWorkMaterialStates, orderBy, materialLink.',
  ),
  'materialDriveId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `materialDriveId`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'courseWorkMaterialStates' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `courseWorkMaterialStates`.',
    'enum' =>
    array (
      0 => 'COURSEWORK_MATERIAL_STATE_UNSPECIFIED',
      1 => 'PUBLISHED',
      2 => 'DRAFT',
      3 => 'DELETED',
    ),
  ),
  'orderBy' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orderBy`.',
  ),
  'materialLink' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `materialLink`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/courses/{courseId}/courseWorkMaterials';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'materialDriveId',
  1 => 'pageToken',
  2 => 'pageSize',
  3 => 'courseWorkMaterialStates',
  4 => 'orderBy',
  5 => 'materialLink',
);
    protected const BODY_REQUIRED = false;
}