<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Invoke action invokeAction.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /security/identities/identityAccounts/{identityAccounts-id}/microsoft.graph.security.invokeAction.
 */
class MicrosoftGraphSecurityIdentitiesIdentityAccountsIdentityAccountsInvokeAction extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_identities_identity_accounts_identity_accounts_invoke_action';
    protected const DESCRIPTION = 'Invoke action invokeAction\n\nOfficial Microsoft Graph v1.0 endpoint: POST /security/identities/identityAccounts/{identityAccounts-id}/microsoft.graph.security.invokeAction.';
    protected const PARAMETERS = ['identity_accounts_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `identityAccounts-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph security OpenAPI schema for this operation.']];
    protected const METHOD = 'POST';
    protected const PATH = '/security/identities/identityAccounts/{identityAccounts-id}/microsoft.graph.security.invokeAction';
    protected const PATH_PARAMS = ['identityAccounts-id' => 'identity_accounts_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}
