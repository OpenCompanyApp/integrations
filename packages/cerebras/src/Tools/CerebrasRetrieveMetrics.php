<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * Retrieve Cerebras Prometheus metrics.
 */
class CerebrasRetrieveMetrics extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_retrieve_metrics';
    protected const DESCRIPTION = 'Retrieve Cerebras Prometheus metrics.';
    protected const METHOD = 'GET';
    protected const PATH = 'https://cloud.cerebras.ai/api/v1/metrics/organizations/{organization_id}';
    protected const PATH_PARAMS = ['organization_id'];
    protected const PARAMETERS = ['organization_id' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras organization_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
