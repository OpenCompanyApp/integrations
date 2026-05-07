<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Get vault information for a secret incident.
 *
 * Maps to the official GitGuardian endpoint GET /v1/incidents/secrets/{incident_id}/vaults.
 */
class GitGuardianGetSecretIncidentVaults extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_get_secret_incident_vaults';
    protected const DESCRIPTION = 'Returns detailed vault path information if the secret is stored in a vault. This endpoint requires the NHI (Non-Human Identity) feature to be enabled and the `show_vault_path_in_public_api` setting to be active. If either condition is not met, an empty array is returned.

Official GitGuardian endpoint: GET /v1/incidents/secrets/{incident_id}/vaults.';
    protected const PARAMETERS = [
        'incident_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the incident to retrieve',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/incidents/secrets/{incident_id}/vaults';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
