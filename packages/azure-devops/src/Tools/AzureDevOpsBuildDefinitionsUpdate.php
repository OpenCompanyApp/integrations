<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Updates an existing build definition. In order for this operation to succeed, the value of the "Revision" property of the request body must match the existing build definition's. It is recommended that you obtain the existing build definition by using GET, modify the build definition as necessary, and then submit the modified definition with PUT..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://dev.azure.com/{organization}/{project}/_apis/build/definitions/{definitionId}.
 */
class AzureDevOpsBuildDefinitionsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_definitions_update';
    protected const DESCRIPTION = 'Updates an existing build definition. In order for this operation to succeed, the value of the "Revision" property of the request body must match the existing build definition\'s. It is recommended that you obtain the existing build definition by using GET, modify the build definition as necessary, and then submit the modified definition with PUT.

Official Azure DevOps REST API 7.2 endpoint: PUT https://dev.azure.com/{organization}/{project}/_apis/build/definitions/{definitionId} (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The new version of the definition. Its "Revision" property must match the existing definition for the update to be accepted.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'definition_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the definition.'], 'secrets_source_definition_id' => ['type' => 'number', 'required' => false, 'description' => 'Optional ID of the definition to use as the source for secrets.'], 'secrets_source_definition_revision' => ['type' => 'number', 'required' => false, 'description' => 'Optional revision of the secrets source definition.'], 'cancel_paused_builds' => ['type' => 'boolean', 'required' => false, 'description' => 'If true, cancels paused builds when the pipeline is being enabled from a paused or disabled state.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.8`.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/definitions/{definitionId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'definitionId' => 'definition_id'];
    protected const QUERY_PARAMS = ['secretsSourceDefinitionId' => 'secrets_source_definition_id', 'secretsSourceDefinitionRevision' => 'secrets_source_definition_revision', 'cancelPausedBuilds' => 'cancel_paused_builds', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.8';
}
