<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List severity rules.
 *
 * Maps to the official GitGuardian endpoint GET /v1/severity-rules.
 */
class GitGuardianListSeverityRules extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_severity_rules';
    protected const DESCRIPTION = 'List the severity rules currently active for the workspace. These rules determine how incident severity is automatically assigned. Use the rule `id` to correlate with the `severity_rule_id` field on incidents.

Official GitGuardian endpoint: GET /v1/severity-rules.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/severity-rules';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
