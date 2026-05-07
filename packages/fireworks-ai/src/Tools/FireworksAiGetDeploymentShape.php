<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get Deployment Shape.
 */
class FireworksAiGetDeploymentShape extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_deployment_shape';
    protected const DESCRIPTION = 'Get Deployment Shape.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/deploymentShapes/{deployment_shape_id}';
    protected const PATH_PARAMS = ['account_id', 'deployment_shape_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'deployment_shape_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks deployment_shape_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
