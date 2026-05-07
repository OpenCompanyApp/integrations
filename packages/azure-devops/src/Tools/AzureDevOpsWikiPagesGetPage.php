<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets metadata or content of the wiki page for the provided path. Content negotiation is done based on the `Accept` header sent in the request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/pages.
 */
class AzureDevOpsWikiPagesGetPage extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wiki_pages_get_page';
    protected const DESCRIPTION = 'Gets metadata or content of the wiki page for the provided path. Content negotiation is done based on the `Accept` header sent in the request.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/pages (spec: wiki/7.2/wiki.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'wiki_identifier' => ['type' => 'string', 'required' => true, 'description' => 'Wiki ID or wiki name.'], 'path' => ['type' => 'string', 'required' => false, 'description' => 'Wiki page path.'], 'recursion_level' => ['type' => 'string', 'required' => false, 'description' => 'Recursion level for subpages retrieval. Defaults to `None` (Optional).'], 'version_descriptor_version' => ['type' => 'string', 'required' => false, 'description' => 'Version string identifier (name of tag/branch, SHA1 of commit)'], 'version_descriptor_version_options' => ['type' => 'string', 'required' => false, 'description' => 'Version options - Specify additional modifiers to version (e.g Previous)'], 'version_descriptor_version_type' => ['type' => 'string', 'required' => false, 'description' => 'Version type (branch, tag, or commit). Determines how Id is interpreted'], 'include_content' => ['type' => 'boolean', 'required' => false, 'description' => 'True to include the content of the page in the response for Json content type. Defaults to false (Optional)'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/pages';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'wikiIdentifier' => 'wiki_identifier'];
    protected const QUERY_PARAMS = ['path' => 'path', 'recursionLevel' => 'recursion_level', 'versionDescriptor.version' => 'version_descriptor_version', 'versionDescriptor.versionOptions' => 'version_descriptor_version_options', 'versionDescriptor.versionType' => 'version_descriptor_version_type', 'includeContent' => 'include_content', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
