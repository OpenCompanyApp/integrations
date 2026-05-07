<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Returns page detail corresponding to Page ID..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/pages/{pageId}/stats.
 */
class AzureDevOpsWikiPageStatsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wiki_page_stats_get';
    protected const DESCRIPTION = 'Returns page detail corresponding to Page ID.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/pages/{pageId}/stats (spec: wiki/7.2/wiki.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'wiki_identifier' => ['type' => 'string', 'required' => true, 'description' => 'Wiki ID or wiki name.'], 'page_id' => ['type' => 'number', 'required' => true, 'description' => 'Wiki page ID.'], 'page_views_for_days' => ['type' => 'number', 'required' => false, 'description' => 'last N days from the current day for which page views is to be returned. It\'s inclusive of current day.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/pages/{pageId}/stats';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'wikiIdentifier' => 'wiki_identifier', 'pageId' => 'page_id'];
    protected const QUERY_PARAMS = ['pageViewsForDays' => 'page_views_for_days', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
