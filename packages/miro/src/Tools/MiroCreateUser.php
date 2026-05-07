<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Creates a new user in the organization. Note: All newly provisioned users are added to the default team..
 *
 * Maps to the official Miro endpoint POST /Users.
 */
class MiroCreateUser extends AbstractMiroTool
{
    protected const NAME = 'miro_create_user';
    protected const DESCRIPTION = 'Creates a new user in the organization. Note: All newly provisioned users are added to the default team.

Official Miro endpoint: POST /Users.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/Users';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/scim+json';
}
