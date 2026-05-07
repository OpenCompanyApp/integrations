<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Deletes the wiki corresponding to the wiki ID or wiki name provided..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}.
 */
class AzureDevOpsWikiWikisDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wiki_wikis_delete';
    protected const DESCRIPTION = 'Deletes the wiki corresponding to the wiki ID or wiki name provided.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier} (spec: wiki/7.2/wiki.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'wiki_identifier' => ['type' => 'string', 'required' => true, 'description' => 'Wiki ID or wiki name.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'wikiIdentifier' => 'wiki_identifier', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
