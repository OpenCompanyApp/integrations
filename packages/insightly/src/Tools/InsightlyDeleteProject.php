<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Delete an Insightly project.
 */
class InsightlyDeleteProject extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_delete_project';
    protected string $toolDescription = 'Delete an Insightly project.';
    protected string $method = 'DELETE';
    protected string $path = '/v3.1/Projects/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly project ID to delete.'],
    ];
}
