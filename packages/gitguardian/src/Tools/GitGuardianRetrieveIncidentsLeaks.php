<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Retrieve where a secret has been publicly leaked.
 *
 * Maps to the official GitGuardian endpoint GET /v1/incidents/secrets/{incident_id}/leaks.
 */
class GitGuardianRetrieveIncidentsLeaks extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_retrieve_incidents_leaks';
    protected const DESCRIPTION = 'Retrieve where a secret has been publicly leaked. **Limitations:** - Does not work for multimatch secrets. - Does not return publicly visible internal sources.

Official GitGuardian endpoint: GET /v1/incidents/secrets/{incident_id}/leaks.';
    protected const PARAMETERS = [
        'incident_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the incident to retrieve',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/incidents/secrets/{incident_id}/leaks';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
