<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Call a safe relative Semaphore GET path.
 */
class SemaphoreCiApiGet extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_api_get';
    protected const DESCRIPTION = 'Call a safe relative Semaphore API v1alpha GET path. Prefer named tools when available.';
    protected const METHOD = 'apiGet';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path under /api/v1alpha.'], 'query' => ['type' => 'object', 'description' => 'Query parameters.']];
}
