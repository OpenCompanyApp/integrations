<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Activate a Semaphore deployment target.
 */
class SemaphoreCiActivateDeploymentTarget extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_activate_deployment_target';
    protected const DESCRIPTION = 'Activate a Semaphore deployment target.';
    protected const METHOD = 'activateDeploymentTarget';
    protected const REQUIRED = ['target_id'];
    protected const PARAMETERS = ['target_id' => ['type' => 'string', 'required' => true, 'description' => 'Deployment target UUID.']];
}
