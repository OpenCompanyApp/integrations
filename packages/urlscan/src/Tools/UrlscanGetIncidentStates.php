<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Get Incident States.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/user/incidentstates/{incidentId}/.
 */
class UrlscanGetIncidentStates extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_incident_states';
    protected const DESCRIPTION = 'Get Incident States

Official urlscan.io endpoint: GET /api/v1/user/incidentstates/{incidentId}/.';
    protected const PARAMETERS = [
        'incident_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'ID of incident',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/user/incidentstates/{incidentId}/';
    protected const PATH_PARAMS = [
        'incidentId' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
