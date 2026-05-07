<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Delete an IP allowlist rule.
 *
 * Maps to the official GitGuardian endpoint DELETE /v1/ip-allowlist/{ip_allowlist_rule_id}.
 */
class GitGuardianDeleteIpallowlist extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_delete_ipallowlist';
    protected const DESCRIPTION = 'Delete an existing IP allowlist rule.

Official GitGuardian endpoint: DELETE /v1/ip-allowlist/{ip_allowlist_rule_id}.';
    protected const PARAMETERS = [
        'ip_allowlist_rule_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The id of the IP allowlist rule',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/ip-allowlist/{ip_allowlist_rule_id}';
    protected const PATH_PARAMS = [
        'ip_allowlist_rule_id' => 'ip_allowlist_rule_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
