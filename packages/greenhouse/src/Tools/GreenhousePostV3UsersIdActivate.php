<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Activate a user.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint POST /v3/users/{id}/activate.
 */
class GreenhousePostV3UsersIdActivate extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_post_v3_users_id_activate';
    protected const DESCRIPTION = 'Activate a user

Official Greenhouse Harvest v3 endpoint: POST /v3/users/{id}/activate.';
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
    protected const PATH = '/v3/users/{id}/activate';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
