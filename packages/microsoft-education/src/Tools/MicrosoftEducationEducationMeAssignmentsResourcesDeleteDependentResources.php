<?php

namespace OpenCompany\Integrations\MicrosoftEducation\Tools;

/**
 * Delete navigation property dependentResources for education.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /education/me/assignments/{educationAssignment-id}/resources/{educationAssignmentResource-id}/dependentResources/{educationAssignmentResource-id1}.
 */
class MicrosoftEducationEducationMeAssignmentsResourcesDeleteDependentResources extends AbstractMicrosoftEducationTool
{
    protected const NAME = 'microsoft_education_education_me_assignments_resources_delete_dependent_resources';
    protected const DESCRIPTION = 'Delete navigation property dependentResources for education\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /education/me/assignments/{educationAssignment-id}/resources/{educationAssignmentResource-id}/dependentResources/{educationAssignmentResource-id1}.';
    protected const PARAMETERS = ['education_assignment_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `educationAssignment-id`.'], 'education_assignment_resource_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `educationAssignmentResource-id`.'], 'education_assignment_resource_id1' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `educationAssignmentResource-id1`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/education/me/assignments/{educationAssignment-id}/resources/{educationAssignmentResource-id}/dependentResources/{educationAssignmentResource-id1}';
    protected const PATH_PARAMS = ['educationAssignment-id' => 'education_assignment_id', 'educationAssignmentResource-id' => 'education_assignment_resource_id', 'educationAssignmentResource-id1' => 'education_assignment_resource_id1'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
