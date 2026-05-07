<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get Deployment.
 */
class FireworksAiGetDeployment extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_deployment';
    protected const DESCRIPTION = 'Get Deployment.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/deployments/{deployment_id}';
    protected const PATH_PARAMS = ['account_id', 'deployment_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'deployment_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks deployment_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
