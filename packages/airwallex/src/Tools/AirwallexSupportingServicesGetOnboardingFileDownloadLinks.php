<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Supporting Services > File Service > Get onboarding file download links.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/files/download_links.
 */
class AirwallexSupportingServicesGetOnboardingFileDownloadLinks extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_supporting_services_get_onboarding_file_download_links';
    protected const DESCRIPTION = 'Supporting Services > File Service > Get onboarding file download links.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/files/download_links.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/files/download_links';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
