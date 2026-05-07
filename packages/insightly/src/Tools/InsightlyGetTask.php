<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Fetch an Insightly task by ID.
 */
class InsightlyGetTask extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_get_task';
    protected string $toolDescription = 'Get an Insightly task by ID.';
    protected string $path = '/v3.1/Tasks/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly task ID.'],
    ];
}
