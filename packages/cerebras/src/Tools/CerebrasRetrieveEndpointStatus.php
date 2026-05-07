<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * Retrieve Cerebras endpoint status.
 */
class CerebrasRetrieveEndpointStatus extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_retrieve_endpoint_status';
    protected const DESCRIPTION = 'Retrieve Cerebras endpoint status.';
    protected const METHOD = 'GET';
    protected const PATH = '/management/v1/endpoints/{endpoint_id}';
    protected const PATH_PARAMS = ['endpoint_id'];
    protected const PARAMETERS = ['endpoint_id' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras endpoint_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
