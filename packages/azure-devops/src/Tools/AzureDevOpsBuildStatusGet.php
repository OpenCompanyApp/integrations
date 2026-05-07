<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * <p>Gets the build status for a definition, optionally scoped to a specific branch, stage, job, and configuration.</p> <p>If there are more than one, then it is required to pass in a stageName value when specifying a jobName, and the same rule then applies for both if passing a configuration parameter.</p>.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/build/status/{definition}.
 */
class AzureDevOpsBuildStatusGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_status_get';
    protected const DESCRIPTION = '<p>Gets the build status for a definition, optionally scoped to a specific branch, stage, job, and configuration.</p> <p>If there are more than one, then it is required to pass in a stageName value when specifying a jobName, and the same rule then applies for both if passing a configuration parameter.</p>

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/build/status/{definition} (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'definition' => ['type' => 'string', 'required' => true, 'description' => 'Either the definition name with optional leading folder path, or the definition id.'], 'branch_name' => ['type' => 'string', 'required' => false, 'description' => 'Only consider the most recent build for this branch. If not specified, the default branch is used.'], 'stage_name' => ['type' => 'string', 'required' => false, 'description' => 'Use this stage within the pipeline to render the status.'], 'job_name' => ['type' => 'string', 'required' => false, 'description' => 'Use this job within a stage of the pipeline to render the status.'], 'configuration' => ['type' => 'string', 'required' => false, 'description' => 'Use this job configuration to render the status'], 'label' => ['type' => 'string', 'required' => false, 'description' => 'Replaces the default text on the left side of the badge.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/status/{definition}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'definition' => 'definition'];
    protected const QUERY_PARAMS = ['branchName' => 'branch_name', 'stageName' => 'stage_name', 'jobName' => 'job_name', 'configuration' => 'configuration', 'label' => 'label', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
