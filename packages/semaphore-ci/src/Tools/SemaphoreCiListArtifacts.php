<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * List Semaphore artifacts.
 */
class SemaphoreCiListArtifacts extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_list_artifacts';
    protected const DESCRIPTION = 'List artifacts under project, workflow, or job scope. Path must be relative.';
    protected const METHOD = 'listArtifacts';
    protected const REQUIRED = ['scope', 'scope_id'];
    protected const PARAMETERS = ['scope' => ['type' => 'string', 'required' => true, 'enum' => ['projects', 'workflows', 'jobs'], 'description' => 'Artifact scope namespace.'], 'scope_id' => ['type' => 'string', 'required' => true, 'description' => 'Scope UUID.'], 'path' => ['type' => 'string', 'description' => 'Relative artifact path.']];
}
