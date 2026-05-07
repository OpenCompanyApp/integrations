<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Retrieve a public secret occurrence.
 *
 * Maps to the official GitGuardian endpoint GET /v1/public-incidents/secrets/{incident_id}/occurrences/{occurrence_id}.
 */
class GitGuardianRetrievePublicSecretOccurrence extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_retrieve_public_secret_occurrence';
    protected const DESCRIPTION = 'Retrieve a specific occurrence of a public secret incident detected by the GitGuardian dashboard

Official GitGuardian endpoint: GET /v1/public-incidents/secrets/{incident_id}/occurrences/{occurrence_id}.';
    protected const PARAMETERS = [
        'incident_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the incident to retrieve',
        ],
        'occurrence_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The ID of the occurrence to retrieve',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/public-incidents/secrets/{incident_id}/occurrences/{occurrence_id}';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
        'occurrence_id' => 'occurrence_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
