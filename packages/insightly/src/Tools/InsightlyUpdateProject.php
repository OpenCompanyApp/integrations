<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Update an Insightly project.
 */
class InsightlyUpdateProject extends InsightlyCreateProject
{
    protected string $toolName = 'insightly_update_project';
    protected string $toolDescription = 'Update an Insightly project.';
    protected string $method = 'PUT';
    protected string $path = '/v3.1/Projects';
    protected array $required = ['id'];
    protected array $bodyParams = ['id' => 'PROJECT_ID', 'PROJECT_NAME', 'PROJECT_DETAILS', 'STATUS', 'CATEGORY_ID', 'PIPELINE_ID', 'STAGE_ID', 'RESPONSIBLE_USER_ID', 'STARTED_DATE', 'COMPLETED_DATE', 'CUSTOMFIELDS', 'LINKS'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly project ID.'],
        'PROJECT_NAME' => ['type' => 'string', 'description' => 'Project name.'],
        'PROJECT_DETAILS' => ['type' => 'string', 'description' => 'Project details.'],
        'STATUS' => ['type' => 'string', 'description' => 'Project status.'],
        'CATEGORY_ID' => ['type' => 'integer', 'description' => 'Category ID.'],
        'PIPELINE_ID' => ['type' => 'integer', 'description' => 'Pipeline ID.'],
        'STAGE_ID' => ['type' => 'integer', 'description' => 'Stage ID.'],
        'RESPONSIBLE_USER_ID' => ['type' => 'integer', 'description' => 'Responsible user ID.'],
        'STARTED_DATE' => ['type' => 'string', 'description' => 'Started date.'],
        'COMPLETED_DATE' => ['type' => 'string', 'description' => 'Completed date.'],
        'CUSTOMFIELDS' => ['type' => 'array', 'description' => 'Custom field values.'],
        'LINKS' => ['type' => 'array', 'description' => 'Relationship links.'],
    ];
}
