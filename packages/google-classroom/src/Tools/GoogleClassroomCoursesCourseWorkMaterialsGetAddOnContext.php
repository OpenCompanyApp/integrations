<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Course Work Materials Get Add On Context.
 *
 * Maps to the official Google Classroom endpoint GET /v1/courses/{courseId}/courseWorkMaterials/{itemId}/addOnContext.
 */
class GoogleClassroomCoursesCourseWorkMaterialsGetAddOnContext extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_course_work_materials_get_add_on_context';
    protected const DESCRIPTION = 'Courses Course Work Materials Get Add On Context

Official Google Classroom endpoint: GET /v1/courses/{courseId}/courseWorkMaterials/{itemId}/addOnContext
Gets metadata for Classroom add-ons in the context of a specific post.';
    protected const PARAMETERS = array (
  'courseId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `courseId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
  'itemId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `itemId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: attachmentId, addOnToken, postId.',
  ),
  'attachmentId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `attachmentId`.',
  ),
  'addOnToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `addOnToken`.',
  ),
  'postId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `postId`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/courses/{courseId}/courseWorkMaterials/{itemId}/addOnContext';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'itemId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'attachmentId',
  1 => 'addOnToken',
  2 => 'postId',
);
    protected const BODY_REQUIRED = false;
}