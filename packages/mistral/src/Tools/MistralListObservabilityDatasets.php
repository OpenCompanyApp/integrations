<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List Mistral observability datasets.
 */
class MistralListObservabilityDatasets extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_observability_datasets';
    protected const DESCRIPTION = 'List Mistral observability datasets.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/observability/datasets';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
