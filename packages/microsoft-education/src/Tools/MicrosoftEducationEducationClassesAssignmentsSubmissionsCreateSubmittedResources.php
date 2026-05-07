<?php

namespace OpenCompany\Integrations\MicrosoftEducation\Tools;

/**
 * Create new navigation property to submittedResources for education.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /education/classes/{educationClass-id}/assignments/{educationAssignment-id}/submissions/{educationSubmission-id}/submittedResources.
 */
class MicrosoftEducationEducationClassesAssignmentsSubmissionsCreateSubmittedResources extends AbstractMicrosoftEducationTool
{
    protected const NAME = 'microsoft_education_education_classes_assignments_submissions_create_submitted_resources';
    protected const DESCRIPTION = 'Create new navigation property to submittedResources for education\\n\\nOfficial Microsoft Graph v1.0 endpoint: POST /education/classes/{educationClass-id}/assignments/{educationAssignment-id}/submissions/{educationSubmission-id}/submittedResources.';
    protected const PARAMETERS = ['education_class_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `educationClass-id`.'], 'education_assignment_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `educationAssignment-id`.'], 'education_submission_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `educationSubmission-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'POST';
    protected const PATH = '/education/classes/{educationClass-id}/assignments/{educationAssignment-id}/submissions/{educationSubmission-id}/submittedResources';
    protected const PATH_PARAMS = ['educationClass-id' => 'education_class_id', 'educationAssignment-id' => 'education_assignment_id', 'educationSubmission-id' => 'education_submission_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}
