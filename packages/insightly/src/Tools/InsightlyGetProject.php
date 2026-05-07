<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Fetch an Insightly project by ID.
 */
class InsightlyGetProject extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_get_project';
    protected string $toolDescription = 'Get an Insightly project by ID.';
    protected string $path = '/v3.1/Projects/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly project ID.'],
    ];
}
