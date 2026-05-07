<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List Schemas.
 *
 * Maps to the official WorkOS endpoint get /audit_logs/actions/{actionName}/schemas.
 */
class WorkOSAuditLogValidatorVersionsSchemas extends AbstractWorkOSTool
{
    protected const NAME = 'workos_audit_log_validator_versions_schemas';
    protected const DESCRIPTION = 'List Schemas

Official WorkOS endpoint: GET /audit_logs/actions/{actionName}/schemas

Get a list of all schemas for the Audit Logs action identified by `:name`.';
    protected const PARAMETERS = array (
  'action_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `actionName` from the official WorkOS API operation.',
  ),
  'before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `before` from the official WorkOS API operation.',
  ),
  'after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `after` from the official WorkOS API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official WorkOS API operation.',
  ),
  'order' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `order` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/audit_logs/actions/{actionName}/schemas';
    protected const PATH_PARAMS = array (
  'actionName' => 'action_name',
);
    protected const QUERY_PARAMS = array (
  'before' => 'before',
  'after' => 'after',
  'limit' => 'limit',
  'order' => 'order',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
