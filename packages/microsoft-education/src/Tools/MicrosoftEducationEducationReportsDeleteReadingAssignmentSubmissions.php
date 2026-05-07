<?php

namespace OpenCompany\Integrations\MicrosoftEducation\Tools;

/**
 * Delete navigation property readingAssignmentSubmissions for education.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /education/reports/readingAssignmentSubmissions/{readingAssignmentSubmission-id}.
 */
class MicrosoftEducationEducationReportsDeleteReadingAssignmentSubmissions extends AbstractMicrosoftEducationTool
{
    protected const NAME = 'microsoft_education_education_reports_delete_reading_assignment_submissions';
    protected const DESCRIPTION = 'Delete navigation property readingAssignmentSubmissions for education\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /education/reports/readingAssignmentSubmissions/{readingAssignmentSubmission-id}.';
    protected const PARAMETERS = ['reading_assignment_submission_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `readingAssignmentSubmission-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/education/reports/readingAssignmentSubmissions/{readingAssignmentSubmission-id}';
    protected const PATH_PARAMS = ['readingAssignmentSubmission-id' => 'reading_assignment_submission_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
