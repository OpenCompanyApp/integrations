<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Get one Insightly pipeline stage.
 */
class InsightlyGetPipelineStage extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_get_pipeline_stage';
    protected string $toolDescription = 'Get an Insightly pipeline stage by ID.';
    protected string $path = '/v3.1/PipelineStages/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly pipeline stage ID.'],
    ];
}
