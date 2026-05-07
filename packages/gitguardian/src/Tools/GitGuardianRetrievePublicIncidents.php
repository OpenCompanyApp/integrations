<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Retrieve a public secret incident.
 *
 * Maps to the official GitGuardian endpoint GET /v1/public-incidents/secrets/{incident_id}.
 */
class GitGuardianRetrievePublicIncidents extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_retrieve_public_incidents';
    protected const DESCRIPTION = 'Retrieve public secret incident detected by the GitGuardian dashboard

Official GitGuardian endpoint: GET /v1/public-incidents/secrets/{incident_id}.';
    protected const PARAMETERS = [
        'x_privacy_mode' => [
            'type' => 'string',
            'required' => false,
            'description' => 'When set to `true`, sensitive values in the response are obfuscated (replaced with `<GG>OBFUSCATED</GG>`). Useful for sharing API responses without exposing sensitive data.',
            'enum' => ['true', 'false'],
        ],
        'incident_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the incident to retrieve',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/public-incidents/secrets/{incident_id}';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'X-Privacy-Mode' => 'x_privacy_mode',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
