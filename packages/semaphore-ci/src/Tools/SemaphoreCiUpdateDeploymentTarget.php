<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Update a Semaphore deployment target.
 */
class SemaphoreCiUpdateDeploymentTarget extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_update_deployment_target';
    protected const DESCRIPTION = 'Update a Semaphore deployment target.';
    protected const METHOD = 'updateDeploymentTarget';
    protected const REQUIRED = ['target_id', 'payload'];
    protected const PARAMETERS = ['target_id' => ['type' => 'string', 'required' => true, 'description' => 'Deployment target UUID.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Deployment target payload.']];
}
