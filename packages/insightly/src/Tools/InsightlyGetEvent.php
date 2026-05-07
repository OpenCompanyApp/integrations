<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Get one Insightly event.
 */
class InsightlyGetEvent extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_get_event';
    protected string $toolDescription = 'Get an Insightly event by ID.';
    protected string $path = '/v3.1/Events/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly event ID.'],
    ];
}
