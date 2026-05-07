<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Get one Semaphore deployment target.
 */
class SemaphoreCiGetDeploymentTarget extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_get_deployment_target';
    protected const DESCRIPTION = 'Get one Semaphore deployment target by target_id.';
    protected const METHOD = 'getDeploymentTarget';
    protected const REQUIRED = ['target_id'];
    protected const PARAMETERS = ['target_id' => ['type' => 'string', 'required' => true, 'description' => 'Deployment target UUID.']];
}
