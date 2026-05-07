<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * List code, supply chain, or AI-powered scan findings.
 *
 * Maps to the official Semgrep Web API endpoint get /api/v1/deployments/{deploymentSlug}/findings.
 */
class SemgrepFindingsServiceListFindings extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_findings_service_list_findings';
    protected const DESCRIPTION = 'List code, supply chain, or AI-powered scan findings

Official Semgrep Web API endpoint: GET /api/v1/deployments/{deploymentSlug}/findings

Request the list of code, supply chain, or AI-powered scan findings in an organization, paginated in pages of 100 entries and limited by the `since` timestamp. Findings are returned by `relevant_since` descending (see `since` in the Query Parameters list). Examples: List SAST findings with pagination, List SCA findings since timestamp, List AI-powered scan findings, List findings with filters.';
    protected const PARAMETERS = array (
  'deployment_slug' =>
  array (
    'type' => 'string',
    'description' => 'deploymentSlug parameter.',
    'required' => true,
  ),
  'issue_type' =>
  array (
    'type' => 'string',
    'description' => 'issue_type parameter.',
    'enum' =>
    array (
      0 => 'sast',
      1 => 'sca',
      2 => 'ai_sast',
    ),
  ),
  'since' =>
  array (
    'type' => 'number',
    'description' => 'since parameter.',
  ),
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'dedup' =>
  array (
    'type' => 'boolean',
    'description' => 'dedup parameter.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'page_size parameter.',
  ),
  'repos' =>
  array (
    'type' => 'array',
    'description' => 'repos parameter.',
  ),
  'repository_ids' =>
  array (
    'type' => 'array',
    'description' => 'repository_ids parameter.',
  ),
  'status' =>
  array (
    'type' => 'string',
    'description' => 'status parameter.',
    'enum' =>
    array (
      0 => 'open',
      1 => 'fixed',
      2 => 'ignored',
      3 => 'reviewing',
      4 => 'fixing',
      5 => 'provisionally_ignored',
    ),
  ),
  'triage_reasons' =>
  array (
    'type' => 'array',
    'description' => 'triage_reasons parameter.',
    'enum' =>
    array (
      0 => 'acceptable_risk',
      1 => 'false_positive',
      2 => 'no_time',
      3 => 'no_triage_reason',
      4 => 'duplicate',
    ),
  ),
  'severities' =>
  array (
    'type' => 'array',
    'description' => 'severities parameter.',
    'enum' =>
    array (
      0 => 'low',
      1 => 'medium',
      2 => 'high',
      3 => 'critical',
    ),
  ),
  'ref' =>
  array (
    'type' => 'string',
    'description' => 'ref parameter.',
  ),
  'policies' =>
  array (
    'type' => 'array',
    'description' => 'policies parameter.',
  ),
  'rules' =>
  array (
    'type' => 'array',
    'description' => 'rules parameter.',
  ),
  'categories' =>
  array (
    'type' => 'array',
    'description' => 'categories parameter.',
  ),
  'confidence' =>
  array (
    'type' => 'string',
    'description' => 'confidence parameter.',
    'enum' =>
    array (
      0 => 'low',
      1 => 'medium',
      2 => 'high',
    ),
  ),
  'autotriage_verdict' =>
  array (
    'type' => 'string',
    'description' => 'autotriage_verdict parameter.',
    'enum' =>
    array (
      0 => 'true_positive',
      1 => 'false_positive',
    ),
  ),
  'component_tags' =>
  array (
    'type' => 'array',
    'description' => 'component_tags parameter.',
  ),
  'exposures' =>
  array (
    'type' => 'array',
    'description' => 'exposures parameter.',
    'enum' =>
    array (
      0 => 'reachable',
      1 => 'always_reachable',
      2 => 'conditionally_reachable',
      3 => 'unreachable',
      4 => 'unknown',
    ),
  ),
  'transitivities' =>
  array (
    'type' => 'array',
    'description' => 'transitivities parameter.',
    'enum' =>
    array (
      0 => 'direct',
      1 => 'transitive',
      2 => 'unknown',
    ),
  ),
  'is_malicious' =>
  array (
    'type' => 'string',
    'description' => 'is_malicious parameter.',
  ),
  'click_to_fix_pr_state' =>
  array (
    'type' => 'array',
    'description' => 'click_to_fix_pr_state parameter.',
    'enum' =>
    array (
      0 => 'open',
      1 => 'merged',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/deployments/{deploymentSlug}/findings';
    protected const PATH_PARAMS = array (
  'deploymentSlug' => 'deployment_slug',
);
    protected const QUERY_PARAMS = array (
  'issue_type' => 'issue_type',
  'since' => 'since',
  'page' => 'page',
  'dedup' => 'dedup',
  'page_size' => 'page_size',
  'repos' => 'repos',
  'repository_ids' => 'repository_ids',
  'status' => 'status',
  'triage_reasons' => 'triage_reasons',
  'severities' => 'severities',
  'ref' => 'ref',
  'policies' => 'policies',
  'rules' => 'rules',
  'categories' => 'categories',
  'confidence' => 'confidence',
  'autotriage_verdict' => 'autotriage_verdict',
  'component_tags' => 'component_tags',
  'exposures' => 'exposures',
  'transitivities' => 'transitivities',
  'is_malicious' => 'is_malicious',
  'click_to_fix_pr_state' => 'click_to_fix_pr_state',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
