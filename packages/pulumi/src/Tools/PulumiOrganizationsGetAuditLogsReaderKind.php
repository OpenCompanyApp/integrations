<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetAuditLogsReaderKind.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/auditlogs/reader-kind.
 */
class PulumiOrganizationsGetAuditLogsReaderKind extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_audit_logs_reader_kind';
    protected const DESCRIPTION = 'GetAuditLogsReaderKind

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/auditlogs/reader-kind

GetAuditLogsReaderKind returns whether the audit log is being read from MySQL or DynamoDB to control the event filtering UI on the front end.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/auditlogs/reader-kind';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
