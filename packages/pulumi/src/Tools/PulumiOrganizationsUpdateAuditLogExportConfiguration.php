<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateAuditLogExportConfiguration.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/auditlogs/export/config.
 */
class PulumiOrganizationsUpdateAuditLogExportConfiguration extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_update_audit_log_export_configuration';
    protected const DESCRIPTION = 'UpdateAuditLogExportConfiguration

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/auditlogs/export/config

Creates or updates the organization\'s automated audit log export configuration. Audit log export enables automatic delivery of audit events to an S3 bucket for long-term retention and SIEM integration. The configuration includes the S3 bucket details and IAM role for authentication. This feature is available on Business Critical edition.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
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
