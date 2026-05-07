<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Get Semaphore artifact retention policy.
 */
class SemaphoreCiGetArtifactRetentionPolicy extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_get_artifact_retention_policy';
    protected const DESCRIPTION = 'Get artifact retention policy for a Semaphore project.';
    protected const METHOD = 'getArtifactRetentionPolicy';
    protected const REQUIRED = ['project_id'];
    protected const PARAMETERS = ['project_id' => ['type' => 'string', 'required' => true, 'description' => 'Project UUID.']];
}
