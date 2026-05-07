<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get all the memberships where this descriptor is a member in the relationship. The default value for direction is 'up' meaning return all memberships where the subject is a member (e.g. all groups the subject is a member of). Alternatively, passing the direction as 'down' will return all memberships where the subject is a container (e.g. all members of the subject group)..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vssps.dev.azure.com/{organization}/_apis/graph/Memberships/{subjectDescriptor}.
 */
class AzureDevOpsGraphMembershipsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_graph_memberships_list';
    protected const DESCRIPTION = 'Get all the memberships where this descriptor is a member in the relationship. The default value for direction is \'up\' meaning return all memberships where the subject is a member (e.g. all groups the subject is a member of). Alternatively, passing the direction as \'down\' will return all memberships where the subject is a container (e.g. all members of the subject group).

Official Azure DevOps REST API 7.2 endpoint: GET https://vssps.dev.azure.com/{organization}/_apis/graph/Memberships/{subjectDescriptor} (spec: graph/7.2/graph.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'subject_descriptor' => ['type' => 'string', 'required' => true, 'description' => 'Fetch all direct memberships of this descriptor.'], 'direction' => ['type' => 'string', 'required' => false, 'description' => 'Defaults to Up.'], 'depth' => ['type' => 'number', 'required' => false, 'description' => 'The maximum number of edges to traverse up or down the membership tree. Currently the only supported value is \'1\'.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/graph/Memberships/{subjectDescriptor}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'subjectDescriptor' => 'subject_descriptor'];
    protected const QUERY_PARAMS = ['direction' => 'direction', 'depth' => 'depth', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
