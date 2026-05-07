<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets a list of definitions..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/build/definitions.
 */
class AzureDevOpsBuildDefinitionsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_definitions_list';
    protected const DESCRIPTION = 'Gets a list of definitions.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/build/definitions (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'name' => ['type' => 'string', 'required' => false, 'description' => 'If specified, filters to definitions whose names match this pattern.'], 'repository_id' => ['type' => 'string', 'required' => false, 'description' => 'A repository ID. If specified, filters to definitions that use this repository.'], 'repository_type' => ['type' => 'string', 'required' => false, 'description' => 'If specified, filters to definitions that have a repository of this type.'], 'query_order' => ['type' => 'string', 'required' => false, 'description' => 'Indicates the order in which definitions should be returned.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'The maximum number of definitions to return.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'A continuation token, returned by a previous call to this method, that can be used to return the next set of definitions.'], 'min_metrics_time' => ['type' => 'string', 'required' => false, 'description' => 'If specified, indicates the date from which metrics should be included.'], 'definition_ids' => ['type' => 'string', 'required' => false, 'description' => 'A comma-delimited list that specifies the IDs of definitions to retrieve.'], 'path' => ['type' => 'string', 'required' => false, 'description' => 'If specified, filters to definitions under this folder.'], 'built_after' => ['type' => 'string', 'required' => false, 'description' => 'If specified, filters to definitions that have builds after this date.'], 'not_built_after' => ['type' => 'string', 'required' => false, 'description' => 'If specified, filters to definitions that do not have builds after this date.'], 'include_all_properties' => ['type' => 'boolean', 'required' => false, 'description' => 'Indicates whether the full definitions should be returned. By default, shallow representations of the definitions are returned.'], 'include_latest_builds' => ['type' => 'boolean', 'required' => false, 'description' => 'Indicates whether to return the latest and latest completed builds for this definition.'], 'task_id_filter' => ['type' => 'string', 'required' => false, 'description' => 'If specified, filters to definitions that use the specified task.'], 'process_type' => ['type' => 'number', 'required' => false, 'description' => 'If specified, filters to definitions with the given process type.'], 'yaml_filename' => ['type' => 'string', 'required' => false, 'description' => 'If specified, filters to YAML definitions that match the given filename. To use this filter includeAllProperties should be set to true'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.8`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/definitions';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['name' => 'name', 'repositoryId' => 'repository_id', 'repositoryType' => 'repository_type', 'queryOrder' => 'query_order', '$top' => 'top', 'continuationToken' => 'continuation_token', 'minMetricsTime' => 'min_metrics_time', 'definitionIds' => 'definition_ids', 'path' => 'path', 'builtAfter' => 'built_after', 'notBuiltAfter' => 'not_built_after', 'includeAllProperties' => 'include_all_properties', 'includeLatestBuilds' => 'include_latest_builds', 'taskIdFilter' => 'task_id_filter', 'processType' => 'process_type', 'yamlFilename' => 'yaml_filename', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.8';
}
