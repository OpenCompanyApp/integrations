<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Invitations List.
 *
 * Maps to the official Google Classroom endpoint GET /v1/invitations.
 */
class GoogleClassroomInvitationsList extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_invitations_list';
    protected const DESCRIPTION = 'Invitations List

Official Google Classroom endpoint: GET /v1/invitations
Returns a list of invitations that the requesting user is permitted to view, restricted to those that match the list request.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Classroom method. Known keys: courseId, pageSize, userId, pageToken.',
  ),
  'courseId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `courseId`.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'userId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userId`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/invitations';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'courseId',
  1 => 'pageSize',
  2 => 'userId',
  3 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}