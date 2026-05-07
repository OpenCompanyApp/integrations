<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Get Incident.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/user/incidents/{incidentId}.
 */
class UrlscanGetIncident extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_incident';
    protected const DESCRIPTION = 'Get Incident

Official urlscan.io endpoint: GET /api/v1/user/incidents/{incidentId}.';
    protected const PARAMETERS = [
        'incident_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'ID of incident',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/user/incidents/{incidentId}';
    protected const PATH_PARAMS = [
        'incidentId' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
