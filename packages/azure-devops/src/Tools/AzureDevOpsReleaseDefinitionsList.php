<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of release definitions..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/definitions.
 */
class AzureDevOpsReleaseDefinitionsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_release_definitions_list';
    protected const DESCRIPTION = 'Get a list of release definitions.

Official Azure DevOps REST API 7.2 endpoint: GET https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/definitions (spec: release/7.2/release.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'search_text' => ['type' => 'string', 'required' => false, 'description' => 'Get release definitions with names containing searchText.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'The properties that should be expanded in the list of Release definitions.'], 'artifact_type' => ['type' => 'string', 'required' => false, 'description' => 'Release definitions with given artifactType will be returned. Values can be Build, Jenkins, GitHub, Nuget, Team Build (external), ExternalTFSBuild, Git, TFVC, ExternalTfsXamlBuild.'], 'artifact_source_id' => ['type' => 'string', 'required' => false, 'description' => 'Release definitions with given artifactSourceId will be returned. e.g. For build it would be {projectGuid}:{BuildDefinitionId}, for Jenkins it would be {JenkinsConnectionId}:{JenkinsDefinitionId}, for TfsOnPrem it would be {TfsOnPremConnectionId}:{ProjectName}:{TfsOnPremDefinitionId}. For third-party artifacts e.g. TeamCity, BitBucket you may refer \'uniqueSourceIdentifier\' inside vss-extension.json at https://github.com/Microsoft/vsts-rm-extensions/blob/master/Extensions.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Number of release definitions to get.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'Gets the release definitions after the continuation token provided.'], 'query_order' => ['type' => 'string', 'required' => false, 'description' => 'Gets the results in the defined order. Default is \'IdAscending\'.'], 'path' => ['type' => 'string', 'required' => false, 'description' => 'Gets the release definitions under the specified path.'], 'is_exact_name_match' => ['type' => 'boolean', 'required' => false, 'description' => '\'true\'to gets the release definitions with exact match as specified in searchText. Default is \'false\'.'], 'tag_filter' => ['type' => 'string', 'required' => false, 'description' => 'A comma-delimited list of tags. Only release definitions with these tags will be returned.'], 'property_filters' => ['type' => 'string', 'required' => false, 'description' => 'A comma-delimited list of extended properties to be retrieved. If set, the returned Release Definitions will contain values for the specified property Ids (if they exist). If not set, properties will not be included. Note that this will not filter out any Release Definition from results irrespective of whether it has property set or not.'], 'definition_id_filter' => ['type' => 'string', 'required' => false, 'description' => 'A comma-delimited list of release definitions to retrieve.'], 'is_deleted' => ['type' => 'boolean', 'required' => false, 'description' => '\'true\' to get release definitions that has been deleted. Default is \'false\''], 'search_text_contains_folder_name' => ['type' => 'boolean', 'required' => false, 'description' => '\'true\' to get the release definitions under the folder with name as specified in searchText. Default is \'false\'.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vsrm.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/release/definitions';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['searchText' => 'search_text', '$expand' => 'expand', 'artifactType' => 'artifact_type', 'artifactSourceId' => 'artifact_source_id', '$top' => 'top', 'continuationToken' => 'continuation_token', 'queryOrder' => 'query_order', 'path' => 'path', 'isExactNameMatch' => 'is_exact_name_match', 'tagFilter' => 'tag_filter', 'propertyFilters' => 'property_filters', 'definitionIdFilter' => 'definition_id_filter', 'isDeleted' => 'is_deleted', 'searchTextContainsFolderName' => 'search_text_contains_folder_name', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}
