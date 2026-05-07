<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List secret incidents a team has access to.
 *
 * Maps to the official GitGuardian endpoint GET /v1/teams/{team_id}/secret-incidents.
 */
class GitGuardianListTeamSecretIncidentAccess extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_team_secret_incident_access';
    protected const DESCRIPTION = 'List secret incidents that a team has access to.

Official GitGuardian endpoint: GET /v1/teams/{team_id}/secret-incidents.';
    protected const PARAMETERS = [
        'team_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the team',
        ],
        'cursor' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Pagination cursor.',
        ],
        'page' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Page number.',
        ],
        'per_page' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Number of items to list per page.',
        ],
        'date_before' => [
            'type' => 'string',
            'required' => false,
            'description' => 'date_before',
        ],
        'date_after' => [
            'type' => 'string',
            'required' => false,
            'description' => 'date_after',
        ],
        'assignee_email' => [
            'type' => 'string',
            'required' => false,
            'description' => 'assignee_email',
        ],
        'assignee_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'assignee_id',
        ],
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'status',
        ],
        'severity' => [
            'type' => 'string',
            'required' => false,
            'description' => 'severity',
        ],
        'validity' => [
            'type' => 'string',
            'required' => false,
            'description' => 'validity',
        ],
        'tags' => [
            'type' => 'string',
            'required' => false,
            'description' => 'tags',
        ],
        'custom_tags' => [
            'type' => 'string',
            'required' => false,
            'description' => 'custom_tags',
        ],
        'custom_tag_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'custom_tag_key',
        ],
        'custom_tag_value' => [
            'type' => 'string',
            'required' => false,
            'description' => 'custom_tag_value',
        ],
        'ordering' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
            'enum' => ['date', '-date', 'resolved_at', '-resolved_at', 'ignored_at', '-ignored_at'],
        ],
        'detector_group_name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'detector_group_name',
        ],
        'ignorer_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'ignorer_id',
        ],
        'ignorer_api_token_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'ignorer_api_token_id',
        ],
        'resolver_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'resolver_id',
        ],
        'resolver_api_token_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'resolver_api_token_id',
        ],
        'feedback' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'feedback',
        ],
        'only_on_provider_archived_sources' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'only_on_provider_archived_sources',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/teams/{team_id}/secret-incidents';
    protected const PATH_PARAMS = [
        'team_id' => 'team_id',
    ];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'page' => 'page',
        'per_page' => 'per_page',
        'date_before' => 'date_before',
        'date_after' => 'date_after',
        'assignee_email' => 'assignee_email',
        'assignee_id' => 'assignee_id',
        'status' => 'status',
        'severity' => 'severity',
        'validity' => 'validity',
        'tags' => 'tags',
        'custom_tags' => 'custom_tags',
        'custom_tag_key' => 'custom_tag_key',
        'custom_tag_value' => 'custom_tag_value',
        'ordering' => 'ordering',
        'detector_group_name' => 'detector_group_name',
        'ignorer_id' => 'ignorer_id',
        'ignorer_api_token_id' => 'ignorer_api_token_id',
        'resolver_id' => 'resolver_id',
        'resolver_api_token_id' => 'resolver_api_token_id',
        'feedback' => 'feedback',
        'only_on_provider_archived_sources' => 'only_on_provider_archived_sources',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
