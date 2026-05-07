<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Create code fix requests.
 *
 * Maps to the official GitGuardian endpoint POST /v1/code-fix-requests.
 */
class GitGuardianCreateCodeFixRequest extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_create_code_fix_request';
    protected const DESCRIPTION = 'Create code fix requests for multiple secret incidents with their locations. This will generate pull requests to automatically remediate the detected secrets. Each request must include: - One or more issues (by issue_id) - One or more location IDs for each issue The system will group locations by source repository and create one pull request per source.

Official GitGuardian endpoint: POST /v1/code-fix-requests.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/code-fix-requests';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
