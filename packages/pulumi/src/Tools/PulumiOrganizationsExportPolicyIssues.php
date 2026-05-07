<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ExportPolicyIssues.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/policyresults/issues/export.
 */
class PulumiOrganizationsExportPolicyIssues extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_export_policy_issues';
    protected const DESCRIPTION = 'ExportPolicyIssues

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/policyresults/issues/export

Exports policy issues for an organization to CSV format for offline analysis or reporting. Policy issues represent violations detected by Policy Packs during stack updates or continuous compliance scans. The export includes issue details such as the violating resource, policy name, enforcement level, and severity.';
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
    protected const PATH = '/api/orgs/{orgName}/policyresults/issues/export';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
