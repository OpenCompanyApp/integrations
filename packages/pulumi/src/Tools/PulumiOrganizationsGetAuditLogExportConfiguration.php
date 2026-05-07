<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetAuditLogExportConfiguration.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/auditlogs/export/config.
 */
class PulumiOrganizationsGetAuditLogExportConfiguration extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_audit_log_export_configuration';
    protected const DESCRIPTION = 'GetAuditLogExportConfiguration

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/auditlogs/export/config

GetAuditLogExportConfiguration returns the organization\'s current audit log export configuration. If the organization has not configured its audit logs for export, returns a 404.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/auditlogs/export/config';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
