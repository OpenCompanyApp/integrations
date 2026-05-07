<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Update the navigation property dispositionReviewStages in security.
 *
 * Maps to Microsoft Graph v1.0 endpoint PATCH /security/labels/retentionLabels/{retentionLabel-id}/dispositionReviewStages/{dispositionReviewStage-stageNumber}.
 */
class MicrosoftGraphSecurityLabelsRetentionLabelsUpdateDispositionReviewStages extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_labels_retention_labels_update_disposition_review_stages';
    protected const DESCRIPTION = 'Update the navigation property dispositionReviewStages in security\n\nOfficial Microsoft Graph v1.0 endpoint: PATCH /security/labels/retentionLabels/{retentionLabel-id}/dispositionReviewStages/{dispositionReviewStage-stageNumber}.';
    protected const PARAMETERS = ['retention_label_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `retentionLabel-id`.'], 'disposition_review_stage_stage_number' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `dispositionReviewStage-stageNumber`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph security OpenAPI schema for this operation.']];
    protected const METHOD = 'PATCH';
    protected const PATH = '/security/labels/retentionLabels/{retentionLabel-id}/dispositionReviewStages/{dispositionReviewStage-stageNumber}';
    protected const PATH_PARAMS = ['retentionLabel-id' => 'retention_label_id', 'dispositionReviewStage-stageNumber' => 'disposition_review_stage_stage_number'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}
