<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Scale Deployment to a specific number of replicas or to zero.
 */
class FireworksAiScaleDeployment extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_scale_deployment';
    protected const DESCRIPTION = 'Scale Deployment to a specific number of replicas or to zero.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/accounts/{account_id}/deployments/{deployment_id}:scale';
    protected const PATH_PARAMS = ['account_id', 'deployment_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'deployment_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks deployment_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
