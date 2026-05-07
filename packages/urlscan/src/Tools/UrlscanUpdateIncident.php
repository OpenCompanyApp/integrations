<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Update Incident options.
 *
 * Maps to the official urlscan.io endpoint PUT /api/v1/user/incidents/{incidentId}.
 */
class UrlscanUpdateIncident extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_update_incident';
    protected const DESCRIPTION = 'Update Incident options

Official urlscan.io endpoint: PUT /api/v1/user/incidents/{incidentId}.';
    protected const PARAMETERS = [
        'incident_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'ID of incident',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v1/user/incidents/{incidentId}';
    protected const PATH_PARAMS = [
        'incidentId' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
