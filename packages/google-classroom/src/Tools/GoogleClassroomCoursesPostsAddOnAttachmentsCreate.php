<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Posts Add On Attachments Create.
 *
 * Maps to the official Google Classroom endpoint POST /v1/courses/{courseId}/posts/{postId}/addOnAttachments.
 */
class GoogleClassroomCoursesPostsAddOnAttachmentsCreate extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_posts_add_on_attachments_create';
    protected const DESCRIPTION = 'Courses Posts Add On Attachments Create

Official Google Classroom endpoint: POST /v1/courses/{courseId}/posts/{postId}/addOnAttachments
Creates an add-on attachment under a post.';
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
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: addOnToken, itemId.',
  ),
  'addOnToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `addOnToken`.',
  ),
  'itemId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `itemId`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Classroom `AddOnAttachment` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/courses/{courseId}/posts/{postId}/addOnAttachments';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'postId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'addOnToken',
  1 => 'itemId',
);
    protected const BODY_REQUIRED = true;
}