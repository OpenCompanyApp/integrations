<?php

namespace OpenCompany\Integrations\MicrosoftEducation\Tools;

/**
 * Remove member from educationClass.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /education/classes/{educationClass-id}/members/{educationUser-id}/$ref.
 */
class MicrosoftEducationEducationClassesMembersDeleteRefEducationUser extends AbstractMicrosoftEducationTool
{
    protected const NAME = 'microsoft_education_education_classes_members_delete_ref_education_user';
    protected const DESCRIPTION = 'Remove member from educationClass\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /education/classes/{educationClass-id}/members/{educationUser-id}/$ref.';
    protected const PARAMETERS = ['education_class_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `educationClass-id`.'], 'education_user_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `educationUser-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/education/classes/{educationClass-id}/members/{educationUser-id}/$ref';
    protected const PATH_PARAMS = ['educationClass-id' => 'education_class_id', 'educationUser-id' => 'education_user_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
