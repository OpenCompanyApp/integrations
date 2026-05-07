<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Delete ediscoveryReviewSetQuery.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /security/cases/ediscoveryCases/{ediscoveryCase-id}/reviewSets/{ediscoveryReviewSet-id}/queries/{ediscoveryReviewSetQuery-id}.
 */
class MicrosoftGraphSecurityCasesEdiscoveryCasesReviewSetsDeleteQueries extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_cases_ediscovery_cases_review_sets_delete_queries';
    protected const DESCRIPTION = 'Delete ediscoveryReviewSetQuery\n\nOfficial Microsoft Graph v1.0 endpoint: DELETE /security/cases/ediscoveryCases/{ediscoveryCase-id}/reviewSets/{ediscoveryReviewSet-id}/queries/{ediscoveryReviewSetQuery-id}.';
    protected const PARAMETERS = ['ediscovery_case_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `ediscoveryCase-id`.'], 'ediscovery_review_set_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `ediscoveryReviewSet-id`.'], 'ediscovery_review_set_query_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `ediscoveryReviewSetQuery-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/security/cases/ediscoveryCases/{ediscoveryCase-id}/reviewSets/{ediscoveryReviewSet-id}/queries/{ediscoveryReviewSetQuery-id}';
    protected const PATH_PARAMS = ['ediscoveryCase-id' => 'ediscovery_case_id', 'ediscoveryReviewSet-id' => 'ediscovery_review_set_id', 'ediscoveryReviewSetQuery-id' => 'ediscovery_review_set_query_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
