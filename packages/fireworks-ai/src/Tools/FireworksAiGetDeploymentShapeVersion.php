<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get Deployment Shape Version.
 */
class FireworksAiGetDeploymentShapeVersion extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_deployment_shape_version';
    protected const DESCRIPTION = 'Get Deployment Shape Version.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/deploymentShapes/{deployment_shape_id}/versions/{version_id}';
    protected const PATH_PARAMS = ['account_id', 'deployment_shape_id', 'version_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'deployment_shape_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks deployment_shape_id.'], 'version_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks version_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
