<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Updates the gate for a deployment..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/gates/{gateStepId}.
 */
class AzureDevOpsReleaseGatesUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_release_gates_update';
    protected const DESCRIPTION = 'Updates the gate for a deployment.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/gates/{gateStepId} (spec: release/7.2/release.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Metadata to patch the Release Gates.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'gate_step_id' => ['type' => 'number', 'required' => true, 'description' => 'Gate step Id.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'vsrm.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/release/gates/{gateStepId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'gateStepId' => 'gate_step_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
