<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * Deploy a Cerebras model to an endpoint.
 */
class CerebrasDeployModelToEndpoint extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_deploy_model_to_endpoint';
    protected const DESCRIPTION = 'Deploy a Cerebras model to an endpoint.';
    protected const METHOD = 'POST';
    protected const PATH = '/management/v1/endpoints/{endpoint_id}:deployModel';
    protected const PATH_PARAMS = ['endpoint_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['endpoint_id' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras endpoint_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'description' => 'Request body or multipart fields matching the Cerebras API schema.']];
}
