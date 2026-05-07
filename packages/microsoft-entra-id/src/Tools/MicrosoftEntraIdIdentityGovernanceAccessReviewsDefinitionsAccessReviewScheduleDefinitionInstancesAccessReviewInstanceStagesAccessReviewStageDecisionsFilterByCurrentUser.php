<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Invoke function filterByCurrentUser.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /identityGovernance/accessReviews/definitions/{accessReviewScheduleDefinition-id}/instances/{accessReviewInstance-id}/stages/{accessReviewStage-id}/decisions/filterByCurrentUser(on='{on}').
 */
class MicrosoftEntraIdIdentityGovernanceAccessReviewsDefinitionsAccessReviewScheduleDefinitionInstancesAccessReviewInstanceStagesAccessReviewStageDecisionsFilterByCurrentUser extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_identity_governance_access_reviews_definitions_access_review_schedule_definition_instances_access_review_instance_stages_access_review_stage_decisions_filter_by_current_user';
    protected const DESCRIPTION = 'Invoke function filterByCurrentUser\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /identityGovernance/accessReviews/definitions/{accessReviewScheduleDefinition-id}/instances/{accessReviewInstance-id}/stages/{accessReviewStage-id}/decisions/filterByCurrentUser(on=\'{on}\').';
    protected const PARAMETERS = ['access_review_schedule_definition_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessReviewScheduleDefinition-id`.'], 'access_review_instance_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessReviewInstance-id`.'], 'access_review_stage_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessReviewStage-id`.'], 'on' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `on`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/identityGovernance/accessReviews/definitions/{accessReviewScheduleDefinition-id}/instances/{accessReviewInstance-id}/stages/{accessReviewStage-id}/decisions/filterByCurrentUser(on=\'{on}\')';
    protected const PATH_PARAMS = ['accessReviewScheduleDefinition-id' => 'access_review_schedule_definition_id', 'accessReviewInstance-id' => 'access_review_instance_id', 'accessReviewStage-id' => 'access_review_stage_id', 'on' => 'on'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
