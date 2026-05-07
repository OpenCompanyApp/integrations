<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Create an Insightly team member permission record.
 */
class InsightlyCreateTeamMember extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_create_team_member';
    protected string $toolDescription = 'Create an Insightly team member permission record.';
    protected string $method = 'POST';
    protected string $path = '/v3.1/TeamMembers';
    protected array $required = ['TEAM_ID', 'USER_ID'];
    protected array $bodyParams = ['TEAM_ID', 'USER_ID'];
    protected array $parameters = [
        'TEAM_ID' => ['type' => 'integer', 'required' => true, 'description' => 'Team ID.'],
        'USER_ID' => ['type' => 'integer', 'required' => true, 'description' => 'User ID.'],
    ];
}
