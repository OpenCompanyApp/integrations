<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * List Deployment Shapes Versions.
 */
class FireworksAiListDeploymentShapeVersions extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_list_deployment_shape_versions';
    protected const DESCRIPTION = 'List Deployment Shapes Versions.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/deploymentShapes/{deployment_shape_id}/versions';
    protected const PATH_PARAMS = ['account_id', 'deployment_shape_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'deployment_shape_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks deployment_shape_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
