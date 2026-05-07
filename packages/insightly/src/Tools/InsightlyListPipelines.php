<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List Insightly pipelines.
 */
class InsightlyListPipelines extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_list_pipelines';
    protected string $toolDescription = 'List Insightly pipelines.';
    protected string $path = '/v3.1/Pipelines';
}
