<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ForceAuditLogExport.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/auditlogs/export/config/force.
 */
class PulumiOrganizationsForceAuditLogExport extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_force_audit_log_export';
    protected const DESCRIPTION = 'ForceAuditLogExport

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/auditlogs/export/config/force

ForceAuditLogExport exports the audit logs for the organization for a user-supplied timestamp. This can be used to backfill data that may have been missed due to an outage or permissions issue.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'timestamp' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `timestamp` from the official Pulumi Cloud API operation. Unix timestamp to export audit logs for (used for backfilling missed data)',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/auditlogs/export/config/force';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'timestamp' => 'timestamp',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
