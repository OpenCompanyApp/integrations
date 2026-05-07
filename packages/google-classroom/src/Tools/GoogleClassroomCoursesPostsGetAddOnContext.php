<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Posts Get Add On Context.
 *
 * Maps to the official Google Classroom endpoint GET /v1/courses/{courseId}/posts/{postId}/addOnContext.
 */
class GoogleClassroomCoursesPostsGetAddOnContext extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_posts_get_add_on_context';
    protected const DESCRIPTION = 'Courses Posts Get Add On Context

Official Google Classroom endpoint: GET /v1/courses/{courseId}/posts/{postId}/addOnContext
Gets metadata for Classroom add-ons in the context of a specific post.';
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
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: addOnToken, itemId, attachmentId.',
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
  'attachmentId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `attachmentId`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/courses/{courseId}/posts/{postId}/addOnContext';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'postId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'addOnToken',
  1 => 'itemId',
  2 => 'attachmentId',
);
    protected const BODY_REQUIRED = false;
}