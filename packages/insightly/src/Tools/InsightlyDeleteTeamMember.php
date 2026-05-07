<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Delete an Insightly team member permission record.
 */
class InsightlyDeleteTeamMember extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_delete_team_member';
    protected string $toolDescription = 'Delete an Insightly team member permission record by ID.';
    protected string $method = 'DELETE';
    protected string $path = '/v3.1/TeamMembers/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Team member permission ID.'],
    ];
}
