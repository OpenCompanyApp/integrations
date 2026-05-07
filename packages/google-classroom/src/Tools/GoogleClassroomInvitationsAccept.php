<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Invitations Accept.
 *
 * Maps to the official Google Classroom endpoint POST /v1/invitations/{id}:accept.
 */
class GoogleClassroomInvitationsAccept extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_invitations_accept';
    protected const DESCRIPTION = 'Invitations Accept

Official Google Classroom endpoint: POST /v1/invitations/{id}:accept
Accepts an invitation, removing it and adding the invited user to the teachers or students (as appropriate) of the specified course.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/invitations/{id}:accept';
    protected const PATH_PARAMS = array (
  0 => 'id',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}