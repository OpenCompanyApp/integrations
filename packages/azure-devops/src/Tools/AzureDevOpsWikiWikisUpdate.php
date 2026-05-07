<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Updates the wiki corresponding to the wiki ID or wiki name provided using the update parameters..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}.
 */
class AzureDevOpsWikiWikisUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wiki_wikis_update';
    protected const DESCRIPTION = 'Updates the wiki corresponding to the wiki ID or wiki name provided using the update parameters.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier} (spec: wiki/7.2/wiki.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Update parameters.'], 'wiki_identifier' => ['type' => 'string', 'required' => true, 'description' => 'Wiki ID or wiki name.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'wikiIdentifier' => 'wiki_identifier', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
