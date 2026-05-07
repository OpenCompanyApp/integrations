<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Delete an Insightly event.
 */
class InsightlyDeleteEvent extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_delete_event';
    protected string $toolDescription = 'Delete an Insightly event by ID.';
    protected string $method = 'DELETE';
    protected string $path = '/v3.1/Events/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly event ID.'],
    ];
}
