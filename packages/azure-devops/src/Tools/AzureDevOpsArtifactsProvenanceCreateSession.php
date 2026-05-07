<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Creates a session, a wrapper around a feed that can store additional metadata on the packages published to it..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://pkgs.dev.azure.com/{organization}/{project}/_apis/provenance/session/{protocol}.
 */
class AzureDevOpsArtifactsProvenanceCreateSession extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_provenance_create_session';
    protected const DESCRIPTION = 'Creates a session, a wrapper around a feed that can store additional metadata on the packages published to it.

Official Azure DevOps REST API 7.2 endpoint: POST https://pkgs.dev.azure.com/{organization}/{project}/_apis/provenance/session/{protocol} (spec: artifacts/7.2/provenance.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The feed and metadata for the session'], 'protocol' => ['type' => 'string', 'required' => true, 'description' => 'The protocol that the session will target'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'pkgs.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/provenance/session/{protocol}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'protocol' => 'protocol', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
