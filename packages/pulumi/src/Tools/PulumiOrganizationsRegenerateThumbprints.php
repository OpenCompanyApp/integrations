<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * RegenerateThumbprints.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/oidc/issuers/{issuerId}/regenerate-thumbprints.
 */
class PulumiOrganizationsRegenerateThumbprints extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_regenerate_thumbprints';
    protected const DESCRIPTION = 'RegenerateThumbprints

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/oidc/issuers/{issuerId}/regenerate-thumbprints

Regenerates the TLS certificate thumbprints for an OIDC issuer by re-fetching the issuer\'s public keys. This is needed when the identity provider rotates its TLS certificates. Cannot be used if the issuer\'s JWKS are statically configured.';
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
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/oidc/issuers/{issuerId}/regenerate-thumbprints';
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
