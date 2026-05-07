<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Retrieve the impacted perimeter of a secret incident.
 *
 * Maps to the official GitGuardian endpoint GET /v1/incidents/secrets/{incident_id}/impacted_perimeter.
 */
class GitGuardianRetrieveIncidentImpactedPerimeter extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_retrieve_incident_impacted_perimeter';
    protected const DESCRIPTION = 'Retrieve metrics about the impacted perimeter of a secret incident detected by the GitGuardian dashboard.

Official GitGuardian endpoint: GET /v1/incidents/secrets/{incident_id}/impacted_perimeter.';
    protected const PARAMETERS = [
        'incident_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the incident to retrieve',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/incidents/secrets/{incident_id}/impacted_perimeter';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
