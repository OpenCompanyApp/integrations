<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Trigger a health check.
 *
 * Maps to the official GitGuardian endpoint POST /v1/health-checks/{type}/{instance_id}/trigger.
 */
class GitGuardianTriggerHealthCheck extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_trigger_health_check';
    protected const DESCRIPTION = 'Enqueue a health check for a specific integration instance. The check runs asynchronously. The response includes a `result_url` pointing to the instance history endpoint pre-filtered to checks started after the trigger time, so you can poll for the result. Returns `429` if a health check was performed too recently for this instance.

Official GitGuardian endpoint: POST /v1/health-checks/{type}/{instance_id}/trigger.';
    protected const PARAMETERS = [
        'type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The integration type identifier.',
            'enum' => ['aws-ecr-installation', 'aws-honeytoken-organization', 'aws-s3-installation', 'azure-cr-installation', 'azure-devops-installation', 'bitbucket-cloud-workspace', 'bitbucket-installation', 'confluence-cloud-installation', 'confluence-data-center-installation', 'docker-hub-installation', 'gerrit-installation', 'github-installation', 'gitlab-installation', 'google-artifact-installation', 'jfrog-artifact-installation', 'jfrog-package-installation', 'jira-cloud-installation', 'jira-data-center-installation', 'microsoft-onedrive-installation', 'microsoft-teams-installation', 'red-hat-quay-installation', 'servicenow-installation', 'servicenow-issue-tracking-config', 'sharepoint-online-drive-installation', 'slack-workspace'],
        ],
        'instance_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The ID of the integration instance.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/health-checks/{type}/{instance_id}/trigger';
    protected const PATH_PARAMS = [
        'type' => 'type',
        'instance_id' => 'instance_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
