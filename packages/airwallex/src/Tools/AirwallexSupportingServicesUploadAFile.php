<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Supporting Services > File Service > Upload a file.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/files/upload.
 */
class AirwallexSupportingServicesUploadAFile extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_supporting_services_upload_a_file';
    protected const DESCRIPTION = 'Supporting Services > File Service > Upload a file.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/files/upload.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/files/upload';
    protected const BASE = 'file';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'multipart/form-data';
    protected const AUTH_MODE = 'bearer';
}
