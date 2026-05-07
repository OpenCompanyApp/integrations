<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListPolicyPacks.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/registry/policypacks.
 */
class PulumiRegistryPreviewListPolicyPacksPreviewRegistry extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_preview_list_policy_packs_preview_registry';
    protected const DESCRIPTION = 'ListPolicyPacks

Official Pulumi Cloud endpoint: GET /api/preview/registry/policypacks

Lists all policy packs accessible to the calling user for a given organization. The orgLogin query parameter is required and restricts results to policy packs owned by that organization. Results can optionally be filtered by access level. No authentication is required. Returns 400 if the policy pack access filter value is invalid. This is the deprecated GET variant; prefer the POST ListPolicyPacks endpoint instead.';
    protected const PARAMETERS = array (
  'access' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `access` from the official Pulumi Cloud API operation. Filter by access level',
  ),
  'org_login' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `orgLogin` from the official Pulumi Cloud API operation. Required. Filter by owning organization',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/registry/policypacks';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'access' => 'access',
  'orgLogin' => 'org_login',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
