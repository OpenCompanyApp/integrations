<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get Audit Log Configuration.
 *
 * Maps to the official WorkOS endpoint get /organizations/{id}/audit_log_configuration.
 */
class WorkOSOrganizationsGetAuditLogConfiguration extends AbstractWorkOSTool
{
    protected const NAME = 'workos_organizations_get_audit_log_configuration';
    protected const DESCRIPTION = 'Get Audit Log Configuration

Official WorkOS endpoint: GET /organizations/{id}/audit_log_configuration

Get the unified view of audit log trail and stream configuration for an organization.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/organizations/{id}/audit_log_configuration';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
