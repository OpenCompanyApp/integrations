<?php

namespace OpenCompany\Integrations\MicrosoftEducation\Tools;

/**
 * Delete ref of navigation property categories for education.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /education/me/assignments/{educationAssignment-id}/categories/{educationCategory-id}/$ref.
 */
class MicrosoftEducationEducationMeAssignmentsCategoriesDeleteRefEducationCategory extends AbstractMicrosoftEducationTool
{
    protected const NAME = 'microsoft_education_education_me_assignments_categories_delete_ref_education_category';
    protected const DESCRIPTION = 'Delete ref of navigation property categories for education\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /education/me/assignments/{educationAssignment-id}/categories/{educationCategory-id}/$ref.';
    protected const PARAMETERS = ['education_assignment_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `educationAssignment-id`.'], 'education_category_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `educationCategory-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/education/me/assignments/{educationAssignment-id}/categories/{educationCategory-id}/$ref';
    protected const PATH_PARAMS = ['educationAssignment-id' => 'education_assignment_id', 'educationCategory-id' => 'education_category_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
