<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Update an IP allowlist rule.
 *
 * Maps to the official GitGuardian endpoint PATCH /v1/ip-allowlist/{ip_allowlist_rule_id}.
 */
class GitGuardianUpdateIpallowlist extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_update_ipallowlist';
    protected const DESCRIPTION = 'Update the tag or the IP ranges of an existing IP allowlist rule.

Official GitGuardian endpoint: PATCH /v1/ip-allowlist/{ip_allowlist_rule_id}.';
    protected const PARAMETERS = [
        'ip_allowlist_rule_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The id of the IP allowlist rule',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/ip-allowlist/{ip_allowlist_rule_id}';
    protected const PATH_PARAMS = [
        'ip_allowlist_rule_id' => 'ip_allowlist_rule_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
