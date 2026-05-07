<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Undelete Deployment.
 */
class FireworksAiUndeleteDeployment extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_undelete_deployment';
    protected const DESCRIPTION = 'Undelete Deployment.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/accounts/{account_id}/deployments/{deployment_id}:undelete';
    protected const PATH_PARAMS = ['account_id', 'deployment_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'deployment_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks deployment_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
