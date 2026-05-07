<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets metadata or content of the wiki page for the provided page id. Content negotiation is done based on the `Accept` header sent in the request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/pages/{id}.
 */
class AzureDevOpsWikiPagesGetPageById extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wiki_pages_get_page_by_id';
    protected const DESCRIPTION = 'Gets metadata or content of the wiki page for the provided page id. Content negotiation is done based on the `Accept` header sent in the request.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/pages/{id} (spec: wiki/7.2/wiki.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'wiki_identifier' => ['type' => 'string', 'required' => true, 'description' => 'Wiki ID or wiki name..'], 'id' => ['type' => 'number', 'required' => true, 'description' => 'Wiki page ID.'], 'recursion_level' => ['type' => 'string', 'required' => false, 'description' => 'Recursion level for subpages retrieval. Defaults to `None` (Optional).'], 'include_content' => ['type' => 'boolean', 'required' => false, 'description' => 'True to include the content of the page in the response for Json content type. Defaults to false (Optional)'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/pages/{id}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'wikiIdentifier' => 'wiki_identifier', 'id' => 'id'];
    protected const QUERY_PARAMS = ['recursionLevel' => 'recursion_level', 'includeContent' => 'include_content', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
