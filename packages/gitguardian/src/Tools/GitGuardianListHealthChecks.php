<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List health checks.
 *
 * Maps to the official GitGuardian endpoint GET /v1/health-checks.
 */
class GitGuardianListHealthChecks extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_health_checks';
    protected const DESCRIPTION = 'List the latest health check per integration instance for the authenticated account. Each entry represents the most recent health check run for a given instance. Results can be filtered by integration type and health status.

Official GitGuardian endpoint: GET /v1/health-checks.';
    protected const PARAMETERS = [
        'cursor' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Pagination cursor.',
        ],
        'per_page' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Number of items to list per page.',
        ],
        'type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter by integration type.',
            'enum' => ['aws-ecr-installation', 'aws-honeytoken-organization', 'aws-s3-installation', 'azure-cr-installation', 'azure-devops-installation', 'bitbucket-cloud-workspace', 'bitbucket-installation', 'confluence-cloud-installation', 'confluence-data-center-installation', 'docker-hub-installation', 'gerrit-installation', 'github-installation', 'gitlab-installation', 'google-artifact-installation', 'jfrog-artifact-installation', 'jfrog-package-installation', 'jira-cloud-installation', 'jira-data-center-installation', 'microsoft-onedrive-installation', 'microsoft-teams-installation', 'red-hat-quay-installation', 'servicenow-installation', 'servicenow-issue-tracking-config', 'sharepoint-online-drive-installation', 'slack-workspace'],
        ],
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'status',
            'enum' => ['pass', 'warn', 'fail'],
        ],
        'started_at_after' => [
            'type' => 'string',
            'required' => false,
            'description' => 'started_at_after',
        ],
        'started_at_before' => [
            'type' => 'string',
            'required' => false,
            'description' => 'started_at_before',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/health-checks';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'type' => 'type',
        'status' => 'status',
        'started_at_after' => 'started_at_after',
        'started_at_before' => 'started_at_before',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
