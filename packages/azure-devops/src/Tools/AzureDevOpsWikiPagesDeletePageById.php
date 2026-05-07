<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Deletes a wiki page..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/pages/{id}.
 */
class AzureDevOpsWikiPagesDeletePageById extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wiki_pages_delete_page_by_id';
    protected const DESCRIPTION = 'Deletes a wiki page.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/pages/{id} (spec: wiki/7.2/wiki.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'wiki_identifier' => ['type' => 'string', 'required' => true, 'description' => 'Wiki ID or wiki name.'], 'id' => ['type' => 'number', 'required' => true, 'description' => 'Wiki page ID.'], 'comment' => ['type' => 'string', 'required' => false, 'description' => 'Comment to be associated with this page delete.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/pages/{id}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'wikiIdentifier' => 'wiki_identifier', 'id' => 'id'];
    protected const QUERY_PARAMS = ['comment' => 'comment', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
