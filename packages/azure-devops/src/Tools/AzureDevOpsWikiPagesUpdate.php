<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Edits a wiki page..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/pages/{id}.
 */
class AzureDevOpsWikiPagesUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wiki_pages_update';
    protected const DESCRIPTION = 'Edits a wiki page.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/pages/{id} (spec: wiki/7.2/wiki.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Wiki update operation parameters.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'wiki_identifier' => ['type' => 'string', 'required' => true, 'description' => 'Wiki ID or wiki name.'], 'id' => ['type' => 'number', 'required' => true, 'description' => 'Wiki page ID.'], 'version' => ['type' => 'string', 'required' => false, 'description' => 'Version of the page on which the change is to be made. Mandatory for `Edit` scenario. To be populated in the If-Match header of the request.'], 'comment' => ['type' => 'string', 'required' => false, 'description' => 'Comment to be associated with the page operation.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/pages/{id}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'wikiIdentifier' => 'wiki_identifier', 'id' => 'id'];
    protected const QUERY_PARAMS = ['comment' => 'comment', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = ['Version' => 'version'];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
