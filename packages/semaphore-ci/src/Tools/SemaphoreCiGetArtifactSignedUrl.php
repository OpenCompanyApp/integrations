<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Get a Semaphore artifact signed URL.
 */
class SemaphoreCiGetArtifactSignedUrl extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_get_artifact_signed_url';
    protected const DESCRIPTION = 'Get a signed URL for one artifact file.';
    protected const METHOD = 'getArtifactSignedUrl';
    protected const REQUIRED = ['scope', 'scope_id', 'path'];
    protected const PARAMETERS = ['scope' => ['type' => 'string', 'required' => true, 'enum' => ['projects', 'workflows', 'jobs'], 'description' => 'Artifact scope namespace.'], 'scope_id' => ['type' => 'string', 'required' => true, 'description' => 'Scope UUID.'], 'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative artifact file path.'], 'method' => ['type' => 'string', 'enum' => ['GET', 'HEAD'], 'description' => 'Signed URL HTTP method.']];
}
