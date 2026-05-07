<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Posts Add On Attachments Get.
 *
 * Maps to the official Google Classroom endpoint GET /v1/courses/{courseId}/posts/{postId}/addOnAttachments/{attachmentId}.
 */
class GoogleClassroomCoursesPostsAddOnAttachmentsGet extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_posts_add_on_attachments_get';
    protected const DESCRIPTION = 'Courses Posts Add On Attachments Get

Official Google Classroom endpoint: GET /v1/courses/{courseId}/posts/{postId}/addOnAttachments/{attachmentId}
Returns an add-on attachment.';
    protected const PARAMETERS = array (
  'courseId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `courseId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
  'postId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `postId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
  'attachmentId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `attachmentId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: itemId.',
  ),
  'itemId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `itemId`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/courses/{courseId}/posts/{postId}/addOnAttachments/{attachmentId}';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'postId',
  2 => 'attachmentId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'itemId',
);
    protected const BODY_REQUIRED = false;
}