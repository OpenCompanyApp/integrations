<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Get one Insightly team.
 */
class InsightlyGetTeam extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_get_team';
    protected string $toolDescription = 'Get an Insightly team by ID.';
    protected string $path = '/v3.1/Teams/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly team ID.'],
    ];
}
