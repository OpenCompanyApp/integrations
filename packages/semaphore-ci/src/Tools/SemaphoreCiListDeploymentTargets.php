<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * List Semaphore deployment targets.
 */
class SemaphoreCiListDeploymentTargets extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_list_deployment_targets';
    protected const DESCRIPTION = 'List Semaphore deployment targets by project_id, optionally filtered by target_name.';
    protected const METHOD = 'listDeploymentTargets';
    protected const REQUIRED = ['project_id'];
    protected const PARAMETERS = ['project_id' => ['type' => 'string', 'required' => true, 'description' => 'Project UUID.'], 'target_name' => ['type' => 'string', 'description' => 'Target name filter.'], 'query' => ['type' => 'object', 'description' => 'Additional query parameters.']];
}
