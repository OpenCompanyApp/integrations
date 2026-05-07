<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Delete authenticationCombinationConfiguration.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /identity/conditionalAccess/authenticationStrength/policies/{authenticationStrengthPolicy-id}/combinationConfigurations/{authenticationCombinationConfiguration-id}.
 */
class MicrosoftEntraIdIdentityConditionalAccessAuthenticationStrengthPoliciesDeleteCombinationConfigurations extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_identity_conditional_access_authentication_strength_policies_delete_combination_configurations';
    protected const DESCRIPTION = 'Delete authenticationCombinationConfiguration\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /identity/conditionalAccess/authenticationStrength/policies/{authenticationStrengthPolicy-id}/combinationConfigurations/{authenticationCombinationConfiguration-id}.';
    protected const PARAMETERS = ['authentication_strength_policy_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `authenticationStrengthPolicy-id`.'], 'authentication_combination_configuration_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `authenticationCombinationConfiguration-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/identity/conditionalAccess/authenticationStrength/policies/{authenticationStrengthPolicy-id}/combinationConfigurations/{authenticationCombinationConfiguration-id}';
    protected const PATH_PARAMS = ['authenticationStrengthPolicy-id' => 'authentication_strength_policy_id', 'authenticationCombinationConfiguration-id' => 'authentication_combination_configuration_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
