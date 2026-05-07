<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Call a safe relative Semaphore DELETE path.
 */
class SemaphoreCiApiDelete extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_api_delete';
    protected const DESCRIPTION = 'Call a safe relative Semaphore API v1alpha DELETE path. Prefer named tools when available.';
    protected const METHOD = 'apiDelete';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path under /api/v1alpha.'], 'query' => ['type' => 'object', 'description' => 'Query parameters.']];
}
