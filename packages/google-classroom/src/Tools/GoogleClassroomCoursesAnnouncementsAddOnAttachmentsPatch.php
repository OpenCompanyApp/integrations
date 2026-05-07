<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Announcements Add On Attachments Patch.
 *
 * Maps to the official Google Classroom endpoint PATCH /v1/courses/{courseId}/announcements/{itemId}/addOnAttachments/{attachmentId}.
 */
class GoogleClassroomCoursesAnnouncementsAddOnAttachmentsPatch extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_announcements_add_on_attachments_patch';
    protected const DESCRIPTION = 'Courses Announcements Add On Attachments Patch

Official Google Classroom endpoint: PATCH /v1/courses/{courseId}/announcements/{itemId}/addOnAttachments/{attachmentId}
Updates an add-on attachment.';
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
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: postId, updateMask.',
  ),
  'postId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `postId`.',
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
    'description' => 'JSON request body matching the official Google Classroom `AddOnAttachment` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/courses/{courseId}/announcements/{itemId}/addOnAttachments/{attachmentId}';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'itemId',
  2 => 'attachmentId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'postId',
  1 => 'updateMask',
);
    protected const BODY_REQUIRED = true;
}