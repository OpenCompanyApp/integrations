<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * List Copper pipeline stages.
 */
class CopperListPipelineStages extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_list_pipeline_stages';

    protected string $toolDescription = 'List all Copper pipeline stages.';

    protected string $path = '/pipeline_stages';
}
