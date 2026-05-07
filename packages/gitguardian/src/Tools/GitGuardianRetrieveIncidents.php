<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Retrieve a secret incident.
 *
 * Maps to the official GitGuardian endpoint GET /v1/incidents/secrets/{incident_id}.
 */
class GitGuardianRetrieveIncidents extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_retrieve_incidents';
    protected const DESCRIPTION = 'Retrieve secret incident detected by the GitGuardian dashboard with its occurrences.

Official GitGuardian endpoint: GET /v1/incidents/secrets/{incident_id}.';
    protected const PARAMETERS = [
        'incident_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the incident to retrieve',
        ],
        'with_occurrences' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Retrieve a number of occurrences of this incident.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/incidents/secrets/{incident_id}';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [
        'with_occurrences' => 'with_occurrences',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
