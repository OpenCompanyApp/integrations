<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Posts Add On Attachments Student Submissions Get.
 *
 * Maps to the official Google Classroom endpoint GET /v1/courses/{courseId}/posts/{postId}/addOnAttachments/{attachmentId}/studentSubmissions/{submissionId}.
 */
class GoogleClassroomCoursesPostsAddOnAttachmentsStudentSubmissionsGet extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_posts_add_on_attachments_student_submissions_get';
    protected const DESCRIPTION = 'Courses Posts Add On Attachments Student Submissions Get

Official Google Classroom endpoint: GET /v1/courses/{courseId}/posts/{postId}/addOnAttachments/{attachmentId}/studentSubmissions/{submissionId}
Returns a student submission for an add-on attachment.';
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
  'submissionId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `submissionId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
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
    protected const PATH = '/v1/courses/{courseId}/posts/{postId}/addOnAttachments/{attachmentId}/studentSubmissions/{submissionId}';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'postId',
  2 => 'attachmentId',
  3 => 'submissionId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'itemId',
);
    protected const BODY_REQUIRED = false;
}