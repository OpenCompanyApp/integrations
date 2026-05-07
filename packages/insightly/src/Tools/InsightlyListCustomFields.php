<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List Insightly custom fields for an object type.
 */
class InsightlyListCustomFields extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_list_custom_fields';
    protected string $toolDescription = 'List Insightly custom fields for an object type such as Contacts, Organisations, Opportunities, Projects, Tasks, Leads, or Events.';
    protected string $path = '/v3.1/CustomFields/{objectName}';
    protected array $required = ['objectName'];
    protected array $parameters = [
        'objectName' => ['type' => 'string', 'required' => true, 'description' => 'Insightly object name, for example Contacts or Organisations.'],
    ];
}
