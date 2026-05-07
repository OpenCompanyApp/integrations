<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Get one Insightly user.
 */
class InsightlyGetUser extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_get_user';
    protected string $toolDescription = 'Get an Insightly user by ID.';
    protected string $path = '/v3.1/Users/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly user ID.'],
    ];
}
