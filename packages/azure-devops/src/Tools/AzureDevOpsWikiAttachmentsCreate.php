<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Creates an attachment in the wiki..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://dev.azure.com/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/attachments.
 */
class AzureDevOpsWikiAttachmentsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wiki_attachments_create';
    protected const DESCRIPTION = 'Creates an attachment in the wiki.

Official Azure DevOps REST API 7.2 endpoint: PUT https://dev.azure.com/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/attachments (spec: wiki/7.2/wiki.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Raw payload: provide `content` as a string and optional `content_type`.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'wiki_identifier' => ['type' => 'string', 'required' => true, 'description' => 'Wiki ID or wiki name.'], 'name' => ['type' => 'string', 'required' => false, 'description' => 'Wiki attachment name.'], 'version_descriptor_version' => ['type' => 'string', 'required' => false, 'description' => 'Version string identifier (name of tag/branch, SHA1 of commit)'], 'version_descriptor_version_options' => ['type' => 'string', 'required' => false, 'description' => 'Version options - Specify additional modifiers to version (e.g Previous)'], 'version_descriptor_version_type' => ['type' => 'string', 'required' => false, 'description' => 'Version type (branch, tag, or commit). Determines how Id is interpreted'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wiki/wikis/{wikiIdentifier}/attachments';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'wikiIdentifier' => 'wiki_identifier'];
    protected const QUERY_PARAMS = ['name' => 'name', 'versionDescriptor.version' => 'version_descriptor_version', 'versionDescriptor.versionOptions' => 'version_descriptor_version_options', 'versionDescriptor.versionType' => 'version_descriptor_version_type', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'octet';
    protected const API_VERSION = '7.2-preview.1';
}
