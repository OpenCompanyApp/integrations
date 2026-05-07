<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Invitations Create.
 *
 * Maps to the official Google Classroom endpoint POST /v1/invitations.
 */
class GoogleClassroomInvitationsCreate extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_invitations_create';
    protected const DESCRIPTION = 'Invitations Create

Official Google Classroom endpoint: POST /v1/invitations
Creates an invitation.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Classroom `Invitation` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/invitations';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}