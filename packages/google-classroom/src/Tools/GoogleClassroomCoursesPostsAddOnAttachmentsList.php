<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Posts Add On Attachments List.
 *
 * Maps to the official Google Classroom endpoint GET /v1/courses/{courseId}/posts/{postId}/addOnAttachments.
 */
class GoogleClassroomCoursesPostsAddOnAttachmentsList extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_posts_add_on_attachments_list';
    protected const DESCRIPTION = 'Courses Posts Add On Attachments List

Official Google Classroom endpoint: GET /v1/courses/{courseId}/posts/{postId}/addOnAttachments
Returns all attachments created by an add-on under the post.';
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
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: pageSize, itemId, pageToken.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'itemId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `itemId`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/courses/{courseId}/posts/{postId}/addOnAttachments';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'postId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'itemId',
  2 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}