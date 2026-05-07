<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Delete Custom Field Option.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint DELETE /v3/custom_field_options/{id}.
 */
class GreenhouseDeleteV3CustomFieldOptionsId extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_delete_v3_custom_field_options_id';
    protected const DESCRIPTION = 'Delete Custom Field Option

Official Greenhouse Harvest v3 endpoint: DELETE /v3/custom_field_options/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'path parameter `id`.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v3/custom_field_options/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
