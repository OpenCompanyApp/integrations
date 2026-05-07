<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Revokes the listed OAuth authorizations..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://vssps.dev.azure.com/{organization}/_apis/tokenadmin/revocations.
 */
class AzureDevOpsTokenAdminRevocationsRevokeAuthorizations extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_token_admin_revocations_revoke_authorizations';
    protected const DESCRIPTION = 'Revokes the listed OAuth authorizations.

Official Azure DevOps REST API 7.2 endpoint: POST https://vssps.dev.azure.com/{organization}/_apis/tokenadmin/revocations (spec: tokenAdmin/7.2/tokenAdmin.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The list of objects containing the authorization IDs of the OAuth authorizations, such as session tokens retrieved by listed a users PATs, that should be revoked.'], 'is_public' => ['type' => 'boolean', 'required' => false, 'description' => 'Set to false for PAT tokens and true for SSH tokens.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/tokenadmin/revocations';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['isPublic' => 'is_public', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
