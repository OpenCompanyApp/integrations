<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Trigger scans on sources.
 *
 * Maps to the official GitGuardian endpoint POST /v1/sources/scans.
 */
class GitGuardianTriggerSourceScans extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_trigger_source_scans';
    protected const DESCRIPTION = 'Trigger scans on sources

Official GitGuardian endpoint: POST /v1/sources/scans.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/sources/scans';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
