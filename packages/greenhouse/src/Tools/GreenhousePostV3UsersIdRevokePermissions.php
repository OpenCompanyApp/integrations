<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Revoke user permissions.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint POST /v3/users/{id}/revoke_permissions.
 */
class GreenhousePostV3UsersIdRevokePermissions extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_post_v3_users_id_revoke_permissions';
    protected const DESCRIPTION = 'Revoke user permissions

Official Greenhouse Harvest v3 endpoint: POST /v3/users/{id}/revoke_permissions.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'path parameter `id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v3/users/{id}/revoke_permissions';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
