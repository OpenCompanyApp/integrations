<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Deletes a single user from the organization. Note: A user who is the last admin in the team or the last admin in the organization cannot be deleted. User must be a member in the organization to be deleted. Users that have guest role in the organization cannot be deleted. After a user is deleted, the ownership of all the boards that belong to the deleted user is transferred to the oldest team member who currently has an admin role..
 *
 * Maps to the official Miro endpoint DELETE /Users/{id}.
 */
class MiroDeleteUser extends AbstractMiroTool
{
    protected const NAME = 'miro_delete_user';
    protected const DESCRIPTION = 'Deletes a single user from the organization. Note: A user who is the last admin in the team or the last admin in the organization cannot be deleted. User must be a member in the organization to be deleted. Users that have guest role in the organization cannot be deleted. After a user is deleted, the ownership of all the boards that belong to the deleted user is transferred to the oldest team member who currently has an admin role.

Official Miro endpoint: DELETE /Users/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'User ID. A server-assigned, unique identifier for this user.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/Users/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
