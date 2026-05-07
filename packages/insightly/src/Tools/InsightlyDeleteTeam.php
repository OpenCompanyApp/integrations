<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Delete an Insightly team.
 */
class InsightlyDeleteTeam extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_delete_team';
    protected string $toolDescription = 'Delete an Insightly team by ID.';
    protected string $method = 'DELETE';
    protected string $path = '/v3.1/Teams/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly team ID.'],
    ];
}
