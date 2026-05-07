<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * List secrets.
 *
 * Maps to the official Semgrep Web API endpoint get /api/v1/deployments/{deploymentId}/secrets.
 */
class SemgrepSecretsServiceListSecretsPath extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_secrets_service_list_secrets_path';
    protected const DESCRIPTION = 'List secrets

Official Semgrep Web API endpoint: GET /api/v1/deployments/{deploymentId}/secrets';
    protected const PARAMETERS = array (
  'deployment_id' =>
  array (
    'type' => 'string',
    'description' => 'deploymentId parameter.',
    'required' => true,
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'description' => 'cursor parameter.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'limit parameter.',
  ),
  'since' =>
  array (
    'type' => 'string',
    'description' => 'since parameter.',
  ),
  'validation_state' =>
  array (
    'type' => 'array',
    'description' => 'validationState parameter.',
  ),
  'status' =>
  array (
    'type' => 'string',
    'description' => 'status parameter.',
    'enum' =>
    array (
      0 => 'FINDING_STATUS_UNSPECIFIED',
      1 => 'FINDING_STATUS_OPEN',
      2 => 'FINDING_STATUS_IGNORED',
      3 => 'FINDING_STATUS_FIXED',
      4 => 'FINDING_STATUS_REMOVED',
      5 => 'FINDING_STATUS_UNKNOWN',
      6 => 'FINDING_STATUS_PROVISIONALLY_IGNORED',
    ),
  ),
  'severity' =>
  array (
    'type' => 'array',
    'description' => 'severity parameter.',
  ),
  'repo' =>
  array (
    'type' => 'array',
    'description' => 'repo parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/deployments/{deploymentId}/secrets';
    protected const PATH_PARAMS = array (
  'deploymentId' => 'deployment_id',
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
  'since' => 'since',
  'validationState' => 'validation_state',
  'status' => 'status',
  'severity' => 'severity',
  'repo' => 'repo',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
