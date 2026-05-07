<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Creates a page move operation that updates the path and order of the page as provided in the parameters..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/pagemoves.
 */
class AzureDevOpsWikiPageMovesCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wiki_page_moves_create';
    protected const DESCRIPTION = 'Creates a page move operation that updates the path and order of the page as provided in the parameters.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/pagemoves (spec: wiki/7.2/wiki.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Page more operation parameters.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'wiki_identifier' => ['type' => 'string', 'required' => true, 'description' => 'Wiki ID or wiki name.'], 'comment' => ['type' => 'string', 'required' => false, 'description' => 'Comment that is to be associated with this page move.'], 'version_descriptor_version' => ['type' => 'string', 'required' => false, 'description' => 'Version string identifier (name of tag/branch, SHA1 of commit)'], 'version_descriptor_version_options' => ['type' => 'string', 'required' => false, 'description' => 'Version options - Specify additional modifiers to version (e.g Previous)'], 'version_descriptor_version_type' => ['type' => 'string', 'required' => false, 'description' => 'Version type (branch, tag, or commit). Determines how Id is interpreted'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/pagemoves';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'wikiIdentifier' => 'wiki_identifier'];
    protected const QUERY_PARAMS = ['comment' => 'comment', 'versionDescriptor.version' => 'version_descriptor_version', 'versionDescriptor.versionOptions' => 'version_descriptor_version_options', 'versionDescriptor.versionType' => 'version_descriptor_version_type', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
