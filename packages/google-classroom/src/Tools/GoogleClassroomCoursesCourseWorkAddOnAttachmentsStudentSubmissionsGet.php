<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Courses Course Work Add On Attachments Student Submissions Get.
 *
 * Maps to the official Google Classroom endpoint GET /v1/courses/{courseId}/courseWork/{itemId}/addOnAttachments/{attachmentId}/studentSubmissions/{submissionId}.
 */
class GoogleClassroomCoursesCourseWorkAddOnAttachmentsStudentSubmissionsGet extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_courses_course_work_add_on_attachments_student_submissions_get';
    protected const DESCRIPTION = 'Courses Course Work Add On Attachments Student Submissions Get

Official Google Classroom endpoint: GET /v1/courses/{courseId}/courseWork/{itemId}/addOnAttachments/{attachmentId}/studentSubmissions/{submissionId}
Returns a student submission for an add-on attachment.';
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
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: postId.',
  ),
  'postId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `postId`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/courses/{courseId}/courseWork/{itemId}/addOnAttachments/{attachmentId}/studentSubmissions/{submissionId}';
    protected const PATH_PARAMS = array (
  0 => 'courseId',
  1 => 'itemId',
  2 => 'attachmentId',
  3 => 'submissionId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'postId',
);
    protected const BODY_REQUIRED = false;
}