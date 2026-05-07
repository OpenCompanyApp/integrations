<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Course Work Materials Add On Attachments List.
 *
 * Maps to the official Google Classroom endpoint GET /v1/courses/{courseId}/courseWorkMaterials/{itemId}/addOnAttachments.
 */
class GoogleClassroomCoursesCourseWorkMaterialsAddOnAttachmentsList extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_course_work_materials_add_on_attachments_list';
    protected const DESCRIPTION = 'Courses Course Work Materials Add On Attachments List

Official Google Classroom endpoint: GET /v1/courses/{courseId}/courseWorkMaterials/{itemId}/addOnAttachments
Returns all attachments created by an add-on under the post.';
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
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: postId, pageSize, pageToken.',
  ),
  'postId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `postId`.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/courses/{courseId}/courseWorkMaterials/{itemId}/addOnAttachments';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'itemId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'postId',
  1 => 'pageSize',
  2 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}