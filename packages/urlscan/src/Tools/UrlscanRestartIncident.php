<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Restart Incident.
 *
 * Maps to the official urlscan.io endpoint PUT /api/v1/user/incidents/{incidentId}/restart.
 */
class UrlscanRestartIncident extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_restart_incident';
    protected const DESCRIPTION = 'Restart Incident

Official urlscan.io endpoint: PUT /api/v1/user/incidents/{incidentId}/restart.';
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
    protected const PATH = '/api/v1/user/incidents/{incidentId}/restart';
    protected const PATH_PARAMS = [
        'incidentId' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
