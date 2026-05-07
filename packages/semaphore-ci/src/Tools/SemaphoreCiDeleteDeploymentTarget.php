<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Delete a Semaphore deployment target.
 */
class SemaphoreCiDeleteDeploymentTarget extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_delete_deployment_target';
    protected const DESCRIPTION = 'Delete a Semaphore deployment target. Requires unique_token query parameter.';
    protected const METHOD = 'deleteDeploymentTarget';
    protected const REQUIRED = ['target_id', 'unique_token'];
    protected const PARAMETERS = ['target_id' => ['type' => 'string', 'required' => true, 'description' => 'Deployment target UUID.'], 'unique_token' => ['type' => 'string', 'required' => true, 'description' => 'Idempotency UUID token.']];
}
