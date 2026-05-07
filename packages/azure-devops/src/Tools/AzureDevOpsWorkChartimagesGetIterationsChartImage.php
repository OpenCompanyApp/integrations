<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get an iterations chart image..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/{team}/_apis/work/iterations/chartimages/{name}.
 */
class AzureDevOpsWorkChartimagesGetIterationsChartImage extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_work_chartimages_get_iterations_chart_image';
    protected const DESCRIPTION = 'Get an iterations chart image.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/{team}/_apis/work/iterations/chartimages/{name} (spec: work/7.2/work.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'team' => ['type' => 'string', 'required' => true, 'description' => 'Team ID or team name'], 'name' => ['type' => 'string', 'required' => true, 'description' => 'The chart name. e.g. Velocity.'], 'iterations_number' => ['type' => 'number', 'required' => false, 'description' => 'Number of iterations the chart is for.'], 'width' => ['type' => 'number', 'required' => false, 'description' => 'The width of the chart in pixels. Must be greater than 0.'], 'height' => ['type' => 'number', 'required' => false, 'description' => 'The height of the chart in pixels. Must be greater than 0.'], 'show_details' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether or not the chart should include detailed information (e.g. axis labels, titles, trend lines, etc.)'], 'title' => ['type' => 'string', 'required' => false, 'description' => 'The title of the chart. Can only be dislayed if ShowLabels is true.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/{team}/_apis/work/iterations/chartimages/{name}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'team' => 'team', 'name' => 'name'];
    protected const QUERY_PARAMS = ['iterationsNumber' => 'iterations_number', 'width' => 'width', 'height' => 'height', 'showDetails' => 'show_details', 'title' => 'title', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
