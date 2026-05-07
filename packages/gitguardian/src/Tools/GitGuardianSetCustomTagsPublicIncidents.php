<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Set custom tags of a public secret incident.
 *
 * Maps to the official GitGuardian endpoint POST /v1/public-incidents/secrets/{incident_id}/set_custom_tags.
 */
class GitGuardianSetCustomTagsPublicIncidents extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_set_custom_tags_public_incidents';
    protected const DESCRIPTION = 'Set the custom tags of a public secret incident.

Official GitGuardian endpoint: POST /v1/public-incidents/secrets/{incident_id}/set_custom_tags.';
    protected const PARAMETERS = [
        'incident_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the incident to retrieve',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/public-incidents/secrets/{incident_id}/set_custom_tags';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
