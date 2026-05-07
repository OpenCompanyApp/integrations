<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create Schema.
 *
 * Maps to the official WorkOS endpoint post /audit_logs/actions/{actionName}/schemas.
 */
class WorkOSAuditLogValidatorVersionsCreate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_audit_log_validator_versions_create';
    protected const DESCRIPTION = 'Create Schema

Official WorkOS endpoint: POST /audit_logs/actions/{actionName}/schemas

Creates a new Audit Log schema used to validate the payload of incoming Audit Log Events. If the `action` does not exist, it will also be created.';
    protected const PARAMETERS = array (
  'action_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `actionName` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/audit_logs/actions/{actionName}/schemas';
    protected const PATH_PARAMS = array (
  'actionName' => 'action_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
