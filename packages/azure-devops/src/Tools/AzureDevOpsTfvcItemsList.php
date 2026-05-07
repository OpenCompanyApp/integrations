<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of Tfvc items.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/tfvc/items.
 */
class AzureDevOpsTfvcItemsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_tfvc_items_list';
    protected const DESCRIPTION = 'Get a list of Tfvc items

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/tfvc/items (spec: tfvc/7.2/tfvc.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'scope_path' => ['type' => 'string', 'required' => false, 'description' => 'Version control path of a folder to return multiple items.'], 'recursion_level' => ['type' => 'string', 'required' => false, 'description' => 'None (just the item), or OneLevel (contents of a folder).'], 'include_links' => ['type' => 'boolean', 'required' => false, 'description' => 'True to include links.'], 'version_descriptor_version' => ['type' => 'string', 'required' => false, 'description' => 'Version object.'], 'version_descriptor_version_option' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `versionDescriptor.versionOption`.'], 'version_descriptor_version_type' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `versionDescriptor.versionType`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/tfvc/items';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['scopePath' => 'scope_path', 'recursionLevel' => 'recursion_level', 'includeLinks' => 'include_links', 'versionDescriptor.version' => 'version_descriptor_version', 'versionDescriptor.versionOption' => 'version_descriptor_version_option', 'versionDescriptor.versionType' => 'version_descriptor_version_type', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
