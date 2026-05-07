<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * TestAuditLogExportConfiguration.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/auditlogs/export/config/test.
 */
class PulumiOrganizationsTestAuditLogExportConfiguration extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_test_audit_log_export_configuration';
    protected const DESCRIPTION = 'TestAuditLogExportConfiguration

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/auditlogs/export/config/test

TestAuditLogExportConfiguration uses the provided audit log configuration and checks if we are able to successfully write some data.';
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
    protected const PATH = '/api/orgs/{orgName}/auditlogs/export/config/test';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
