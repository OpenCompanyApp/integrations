<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Get one Insightly pipeline.
 */
class InsightlyGetPipeline extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_get_pipeline';
    protected string $toolDescription = 'Get an Insightly pipeline by ID.';
    protected string $path = '/v3.1/Pipelines/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly pipeline ID.'],
    ];
}
