<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Update Users.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint PATCH /v3/users/{id}.
 */
class GreenhousePatchV3UsersId extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_patch_v3_users_id';
    protected const DESCRIPTION = 'Update Users

Official Greenhouse Harvest v3 endpoint: PATCH /v3/users/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'path parameter `id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/v3/users/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const AUTH_MODE = 'bearer';
}
