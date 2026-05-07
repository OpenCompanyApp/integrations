<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Deactivate a Semaphore deployment target.
 */
class SemaphoreCiDeactivateDeploymentTarget extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_deactivate_deployment_target';
    protected const DESCRIPTION = 'Deactivate a Semaphore deployment target.';
    protected const METHOD = 'deactivateDeploymentTarget';
    protected const REQUIRED = ['target_id'];
    protected const PARAMETERS = ['target_id' => ['type' => 'string', 'required' => true, 'description' => 'Deployment target UUID.']];
}
