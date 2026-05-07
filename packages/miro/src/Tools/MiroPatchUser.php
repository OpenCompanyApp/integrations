<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Updates an existing user resource, overwriting values for specified attributes. Attributes that are not provided will remain unchanged. PATCH operation only updates the fields provided. Note: If the user is not a member in the organization, they cannot be updated. Additionally, users with guest role in the organization cannot be updated..
 *
 * Maps to the official Miro endpoint PATCH /Users/{id}.
 */
class MiroPatchUser extends AbstractMiroTool
{
    protected const NAME = 'miro_patch_user';
    protected const DESCRIPTION = 'Updates an existing user resource, overwriting values for specified attributes. Attributes that are not provided will remain unchanged. PATCH operation only updates the fields provided. Note: If the user is not a member in the organization, they cannot be updated. Additionally, users with guest role in the organization cannot be updated.

Official Miro endpoint: PATCH /Users/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'User ID. A server-assigned, unique identifier for this user.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Payload to update user information. The body of a PATCH request must contain the attribute `Operations`, and its value is an array of one or more PATCH operations. Each PATCH operation object must have exactly one "op" member.',
        'required' => true,
      ),
    );
    protected const METHOD = 'PATCH';
    protected const PATH = '/Users/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/scim+json';
}
