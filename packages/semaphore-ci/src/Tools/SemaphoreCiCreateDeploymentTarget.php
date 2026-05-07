<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Create a Semaphore deployment target.
 */
class SemaphoreCiCreateDeploymentTarget extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_create_deployment_target';
    protected const DESCRIPTION = 'Create a Semaphore deployment target. Provide project_id and official target payload.';
    protected const METHOD = 'createDeploymentTarget';
    protected const REQUIRED = ['project_id', 'payload'];
    protected const PARAMETERS = ['project_id' => ['type' => 'string', 'required' => true, 'description' => 'Project UUID query parameter.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Deployment target payload.']];
}
