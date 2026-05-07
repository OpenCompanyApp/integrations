<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdatePolicyIssue.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/orgs/{orgName}/policyresults/issues/{issueId}.
 */
class PulumiOrganizationsUpdatePolicyIssue extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_update_policy_issue';
    protected const DESCRIPTION = 'UpdatePolicyIssue

Official Pulumi Cloud endpoint: PATCH /api/orgs/{orgName}/policyresults/issues/{issueId}

Updates a policy issue\'s triage status and other mutable fields. All body fields are optional - only provide the fields you want to update. - `status`: `open`, `in_progress`, `by_design`, `fixed`, or `ignored` - `priority`: `p0`, `p1`, `p2`, `p3`, or `p4` - `assignedTo`: username to assign the issue to, or `null` to unassign';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'issue_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `issueId` from the official Pulumi Cloud API operation. The issue identifier',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/orgs/{orgName}/policyresults/issues/{issueId}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'issueId' => 'issue_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
