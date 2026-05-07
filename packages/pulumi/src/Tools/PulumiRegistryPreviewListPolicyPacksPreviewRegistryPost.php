<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListPolicyPacks.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/registry/policypacks.
 */
class PulumiRegistryPreviewListPolicyPacksPreviewRegistryPost extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_preview_list_policy_packs_preview_registry_post';
    protected const DESCRIPTION = 'ListPolicyPacks

Official Pulumi Cloud endpoint: POST /api/preview/registry/policypacks

Lists all policy packs accessible to the calling user, with support for filtering by access level, organization, and specific policy pack IDs. The request body accepts an optional orgLogin to scope results to a specific organization, an optional access level filter (defaults to \'enabled\'), and an optional list of policy pack IDs to restrict the results to specific packs. No authentication is required. Returns 400 if the access filter value is invalid.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/preview/registry/policypacks';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
