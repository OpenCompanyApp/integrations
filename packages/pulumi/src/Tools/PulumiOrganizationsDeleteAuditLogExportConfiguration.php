<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteAuditLogExportConfiguration.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/orgs/{orgName}/auditlogs/export/config.
 */
class PulumiOrganizationsDeleteAuditLogExportConfiguration extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_delete_audit_log_export_configuration';
    protected const DESCRIPTION = 'DeleteAuditLogExportConfiguration

Official Pulumi Cloud endpoint: DELETE /api/orgs/{orgName}/auditlogs/export/config

DeleteAuditLogExportConfiguration removes an organization\'s audit log export settings. Skip feature validation so removal can happen if org no longer has access to feature.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'delete';
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
