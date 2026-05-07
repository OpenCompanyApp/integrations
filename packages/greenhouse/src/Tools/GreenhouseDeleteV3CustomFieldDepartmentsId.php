<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Delete Custom Field Department.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint DELETE /v3/custom_field_departments/{id}.
 */
class GreenhouseDeleteV3CustomFieldDepartmentsId extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_delete_v3_custom_field_departments_id';
    protected const DESCRIPTION = 'Delete Custom Field Department

Official Greenhouse Harvest v3 endpoint: DELETE /v3/custom_field_departments/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'path parameter `id`.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v3/custom_field_departments/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
