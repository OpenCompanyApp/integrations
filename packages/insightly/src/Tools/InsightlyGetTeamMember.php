<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Get one Insightly team member permission record.
 */
class InsightlyGetTeamMember extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_get_team_member';
    protected string $toolDescription = 'Get an Insightly team member permission record by ID.';
    protected string $path = '/v3.1/TeamMembers/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Team member permission ID.'],
    ];
}
