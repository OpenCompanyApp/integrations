<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Copy Incident.
 *
 * Maps to the official urlscan.io endpoint POST /api/v1/user/incidents/{incidentId}/copy.
 */
class UrlscanCopyIncident extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_copy_incident';
    protected const DESCRIPTION = 'Copy Incident

Official urlscan.io endpoint: POST /api/v1/user/incidents/{incidentId}/copy.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/user/incidents/{incidentId}/copy';
    protected const PATH_PARAMS = [
        'incidentId' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
