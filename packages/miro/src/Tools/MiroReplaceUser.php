<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Updates an existing user resource. This is the easiest way to replace user information. If the user is deactivated, userName, userType, and roles.value cannot be updated. emails.value, emails.display, emails.primary get ignored and do not return any error. Note: If the user is not a member in the organization, they cannot be updated. Additionally, users with guest role in the organization cannot be updated..
 *
 * Maps to the official Miro endpoint PUT /Users/{id}.
 */
class MiroReplaceUser extends AbstractMiroTool
{
    protected const NAME = 'miro_replace_user';
    protected const DESCRIPTION = 'Updates an existing user resource. This is the easiest way to replace user information. If the user is deactivated, userName, userType, and roles.value cannot be updated. emails.value, emails.display, emails.primary get ignored and do not return any error. Note: If the user is not a member in the organization, they cannot be updated. Additionally, users with guest role in the organization cannot be updated.

Official Miro endpoint: PUT /Users/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'User ID. A server-assigned, unique identifier for this user.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Payload to update user information.',
        'required' => true,
      ),
    );
    protected const METHOD = 'PUT';
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
