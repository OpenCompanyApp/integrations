<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Create Incident.
 *
 * Maps to the official urlscan.io endpoint POST /api/v1/user/incidents.
 */
class UrlscanCreateIncident extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_create_incident';
    protected const DESCRIPTION = 'Create Incident

Official urlscan.io endpoint: POST /api/v1/user/incidents.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/user/incidents';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
