<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List health check history for an instance.
 *
 * Maps to the official GitGuardian endpoint GET /v1/health-checks/{type}/{instance_id}.
 */
class GitGuardianListHealthCheckInstanceHistory extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_health_check_instance_history';
    protected const DESCRIPTION = 'List all historical health check runs for a specific integration instance, ordered by most recent first by default. The `type` path parameter identifies the integration type using its public name. The `instance_id` is the internal ID of the integration instance (e.g. a GitHub installation, GitLab integration, or Slack workspace).

Official GitGuardian endpoint: GET /v1/health-checks/{type}/{instance_id}.';
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
        'ordering' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sort the results by their field value. The default sort is DESC (most recent first). Prefix with `-` for descending order.',
            'enum' => ['started_at', '-started_at', 'id'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/health-checks/{type}/{instance_id}';
    protected const PATH_PARAMS = [
        'type' => 'type',
        'instance_id' => 'instance_id',
    ];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'status' => 'status',
        'started_at_after' => 'started_at_after',
        'started_at_before' => 'started_at_before',
        'ordering' => 'ordering',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
