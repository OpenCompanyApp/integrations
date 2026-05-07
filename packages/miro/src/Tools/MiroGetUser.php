<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves a single user resource. Note: Returns only users that are members in the organization. It does not return users that are added in the organization as guests..
 *
 * Maps to the official Miro endpoint GET /Users/{id}.
 */
class MiroGetUser extends AbstractMiroTool
{
    protected const NAME = 'miro_get_user';
    protected const DESCRIPTION = 'Retrieves a single user resource. Note: Returns only users that are members in the organization. It does not return users that are added in the organization as guests.

Official Miro endpoint: GET /Users/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'User ID of the user to be retrieved',
        'required' => true,
      ),
      'attributes' => array (
        'type' => 'string',
        'description' => 'A comma-separated list of attribute names to return in the response. Example attributes - id, userName, displayName, name, userType, active, emails, photos, groups, roles. Note: It is also possible to fetch attributes within complex attributes, for Example: emails.value',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/Users/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
      'attributes' => 'attributes',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
