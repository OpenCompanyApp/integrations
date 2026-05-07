<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * List stages in one Copper pipeline.
 */
class CopperListPipelineStagesInPipeline extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_list_pipeline_stages_in_pipeline';

    protected string $toolDescription = 'List stages in a specific Copper pipeline.';

    protected string $path = '/pipeline_stages/pipeline/{pipeline_id}';

    /** @var list<string> */
    protected array $required = ['pipeline_id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'pipeline_id' => ['type' => 'integer', 'required' => true, 'description' => 'Copper pipeline ID.'],
    ];
}
