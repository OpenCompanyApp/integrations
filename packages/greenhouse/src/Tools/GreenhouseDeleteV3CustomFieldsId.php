<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Delete Custom Field.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint DELETE /v3/custom_fields/{id}.
 */
class GreenhouseDeleteV3CustomFieldsId extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_delete_v3_custom_fields_id';
    protected const DESCRIPTION = 'Delete Custom Field

Official Greenhouse Harvest v3 endpoint: DELETE /v3/custom_fields/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'path parameter `id`.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v3/custom_fields/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
