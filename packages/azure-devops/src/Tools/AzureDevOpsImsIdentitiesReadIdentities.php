<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Resolve legacy identity information for use with older APIs such as the Security APIs.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vssps.dev.azure.com/{organization}/_apis/identities.
 */
class AzureDevOpsImsIdentitiesReadIdentities extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_ims_identities_read_identities';
    protected const DESCRIPTION = 'Resolve legacy identity information for use with older APIs such as the Security APIs

Official Azure DevOps REST API 7.2 endpoint: GET https://vssps.dev.azure.com/{organization}/_apis/identities (spec: ims/7.2/identities.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'descriptors' => ['type' => 'string', 'required' => false, 'description' => 'A comma separated list of identity descriptors to resolve'], 'identity_ids' => ['type' => 'string', 'required' => false, 'description' => 'A comma seperated list of storage keys to resolve'], 'subject_descriptors' => ['type' => 'string', 'required' => false, 'description' => 'A comma seperated list of subject descriptors to resolve'], 'search_filter' => ['type' => 'string', 'required' => false, 'description' => 'The type of search to perform. Values can be AccountName (domain\\alias), DisplayName, MailAddress, General (display name, account name, or unique name), or LocalGroupName (only search Azure Devops groups).'], 'filter_value' => ['type' => 'string', 'required' => false, 'description' => 'The search value, as specified by the searchFilter.'], 'query_membership' => ['type' => 'string', 'required' => false, 'description' => 'The membership information to include with the identities. Values can be None for no membership data or Direct to include the groups that the identity is a member of and the identities that are a member of this identity (groups only)'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/identities';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['descriptors' => 'descriptors', 'identityIds' => 'identity_ids', 'subjectDescriptors' => 'subject_descriptors', 'searchFilter' => 'search_filter', 'filterValue' => 'filter_value', 'queryMembership' => 'query_membership', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
