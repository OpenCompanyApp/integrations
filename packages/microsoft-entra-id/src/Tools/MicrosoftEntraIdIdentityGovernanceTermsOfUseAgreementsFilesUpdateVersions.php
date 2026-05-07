<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Update the navigation property versions in identityGovernance.
 *
 * Maps to Microsoft Graph v1.0 endpoint PATCH /identityGovernance/termsOfUse/agreements/{agreement-id}/files/{agreementFileLocalization-id}/versions/{agreementFileVersion-id}.
 */
class MicrosoftEntraIdIdentityGovernanceTermsOfUseAgreementsFilesUpdateVersions extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_identity_governance_terms_of_use_agreements_files_update_versions';
    protected const DESCRIPTION = 'Update the navigation property versions in identityGovernance\\n\\nOfficial Microsoft Graph v1.0 endpoint: PATCH /identityGovernance/termsOfUse/agreements/{agreement-id}/files/{agreementFileLocalization-id}/versions/{agreementFileVersion-id}.';
    protected const PARAMETERS = ['agreement_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `agreement-id`.'], 'agreement_file_localization_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `agreementFileLocalization-id`.'], 'agreement_file_version_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `agreementFileVersion-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'PATCH';
    protected const PATH = '/identityGovernance/termsOfUse/agreements/{agreement-id}/files/{agreementFileLocalization-id}/versions/{agreementFileVersion-id}';
    protected const PATH_PARAMS = ['agreement-id' => 'agreement_id', 'agreementFileLocalization-id' => 'agreement_file_localization_id', 'agreementFileVersion-id' => 'agreement_file_version_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}
