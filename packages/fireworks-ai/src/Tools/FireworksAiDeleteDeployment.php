<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Delete Deployment.
 */
class FireworksAiDeleteDeployment extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_delete_deployment';
    protected const DESCRIPTION = 'Delete Deployment.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/accounts/{account_id}/deployments/{deployment_id}';
    protected const PATH_PARAMS = ['account_id', 'deployment_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'deployment_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks deployment_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
