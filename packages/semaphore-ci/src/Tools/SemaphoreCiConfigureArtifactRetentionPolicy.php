<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Configure Semaphore artifact retention policies.
 */
class SemaphoreCiConfigureArtifactRetentionPolicy extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_configure_artifact_retention_policy';
    protected const DESCRIPTION = 'Configure artifact retention policies for a Semaphore project.';
    protected const METHOD = 'configureArtifactRetentionPolicy';
    protected const REQUIRED = ['payload'];
    protected const PARAMETERS = ['payload' => ['type' => 'object', 'required' => true, 'description' => 'Retention policy payload with project_id and policy lists.']];
}
