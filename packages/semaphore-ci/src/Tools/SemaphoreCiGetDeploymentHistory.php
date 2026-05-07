<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Retrieve Semaphore deployment history.
 */
class SemaphoreCiGetDeploymentHistory extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_get_deployment_history';
    protected const DESCRIPTION = 'Retrieve deployment history for a Semaphore deployment target.';
    protected const METHOD = 'getDeploymentHistory';
    protected const REQUIRED = ['target_id'];
    protected const PARAMETERS = ['target_id' => ['type' => 'string', 'required' => true, 'description' => 'Deployment target UUID.'], 'query' => ['type' => 'object', 'description' => 'Cursor and filter query parameters.']];
}
