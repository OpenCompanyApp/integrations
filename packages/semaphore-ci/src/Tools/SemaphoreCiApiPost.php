<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Call a safe relative Semaphore POST path.
 */
class SemaphoreCiApiPost extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_api_post';
    protected const DESCRIPTION = 'Call a safe relative Semaphore API v1alpha POST path. Prefer named tools when available.';
    protected const METHOD = 'apiPost';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path under /api/v1alpha.'], 'payload' => ['type' => 'object', 'description' => 'JSON request body.']];
}
