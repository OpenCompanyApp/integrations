<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Get a secret detector.
 *
 * Maps to the official GitGuardian endpoint GET /v1/secret_detectors/{detector_name}.
 */
class GitGuardianGetSecretDetector extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_get_secret_detector';
    protected const DESCRIPTION = 'Get a secret detector.

Official GitGuardian endpoint: GET /v1/secret_detectors/{detector_name}.';
    protected const PARAMETERS = [
        'detector_name' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Name of the detector to retrieve',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/secret_detectors/{detector_name}';
    protected const PATH_PARAMS = [
        'detector_name' => 'detector_name',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
