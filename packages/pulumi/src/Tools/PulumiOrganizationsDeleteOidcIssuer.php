<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteOidcIssuer.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/orgs/{orgName}/oidc/issuers/{issuerId}.
 */
class PulumiOrganizationsDeleteOidcIssuer extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_delete_oidc_issuer';
    protected const DESCRIPTION = 'DeleteOidcIssuer

Official Pulumi Cloud endpoint: DELETE /api/orgs/{orgName}/oidc/issuers/{issuerId}

Deletes an OIDC issuer registration from an organization, removing the trust relationship between the organization and the identity provider. After deletion, tokens issued by this provider can no longer be exchanged for temporary Pulumi Cloud credentials. Any deployments or automation relying on this OIDC issuer for authentication will stop working.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'issuer_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `issuerId` from the official Pulumi Cloud API operation. The OIDC issuer identifier',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/orgs/{orgName}/oidc/issuers/{issuerId}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'issuerId' => 'issuer_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
