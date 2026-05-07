<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List Insightly pipeline stages.
 */
class InsightlyListPipelineStages extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_list_pipeline_stages';
    protected string $toolDescription = 'List Insightly pipeline stages.';
    protected string $path = '/v3.1/PipelineStages';
}
