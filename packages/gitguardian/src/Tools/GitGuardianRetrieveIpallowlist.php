<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Retrieve an IP allowlist rule.
 *
 * Maps to the official GitGuardian endpoint GET /v1/ip-allowlist/{ip_allowlist_rule_id}.
 */
class GitGuardianRetrieveIpallowlist extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_retrieve_ipallowlist';
    protected const DESCRIPTION = 'Retrieve an existing IP allowlist rule. If you are using a personal access token, you need to have an access level greater or equal to `manager`.

Official GitGuardian endpoint: GET /v1/ip-allowlist/{ip_allowlist_rule_id}.';
    protected const PARAMETERS = [
        'ip_allowlist_rule_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The id of the IP allowlist rule',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/ip-allowlist/{ip_allowlist_rule_id}';
    protected const PATH_PARAMS = [
        'ip_allowlist_rule_id' => 'ip_allowlist_rule_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
