<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Add or update ACEs in the ACL for the provided token. The request body contains the target token, a list of [ACEs](https://docs.microsoft.com/en-us/rest/api/azure/devops/security/access-control-entries/set-access-control-entries?#accesscontrolentry) and a optional merge parameter. In the case of a collision (by identity descriptor) with an existing ACE in the ACL, the "merge" parameter determines the behavior. If set, the existing ACE has its allow and deny merged with the incoming ACE's allow and deny. If unset, the existing ACE is displaced. For optimal performance and reliability, it is strongly recommended to batch multiple ACEs in a single request rather than sending individual requests. Batching requests improves efficiency, reduces overhead, and helps ensure successful completion of your operations..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/_apis/accesscontrolentries/{securityNamespaceId}.
 */
class AzureDevOpsSecurityAccessControlEntriesSetAccessControlEntries extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_security_access_control_entries_set_access_control_entries';
    protected const DESCRIPTION = 'Add or update ACEs in the ACL for the provided token. The request body contains the target token, a list of [ACEs](https://docs.microsoft.com/en-us/rest/api/azure/devops/security/access-control-entries/set-access-control-entries?#accesscontrolentry) and a optional merge parameter. In the case of a collision (by identity descriptor) with an existing ACE in the ACL, the "merge" parameter determines the behavior. If set, the existing ACE has its allow and deny merged with the incoming ACE\'s allow and deny. If unset, the existing ACE is displaced. For optimal performance and reliability, it is strongly recommended to batch multiple ACEs in a single request rather than sending individual requests. Batching requests improves efficiency, reduces overhead, and helps ensure successful completion of your operations.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/_apis/accesscontrolentries/{securityNamespaceId} (spec: security/7.2/security.json).';
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'security_namespace_id' => ['type' => 'string', 'required' => true, 'description' => 'Security namespace identifier.'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/accesscontrolentries/{securityNamespaceId}';
    protected const PATH_PARAMS = ['securityNamespaceId' => 'security_namespace_id', 'organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
