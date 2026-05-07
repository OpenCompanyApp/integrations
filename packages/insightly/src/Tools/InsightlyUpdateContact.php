<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Update an Insightly contact.
 */
class InsightlyUpdateContact extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_update_contact';
    protected string $toolDescription = 'Update an Insightly contact. Send Insightly field names such as FIRST_NAME, LAST_NAME, EMAIL_ADDRESS, PHONE, CUSTOMFIELDS, or LINKS.';
    protected string $method = 'PUT';
    protected string $path = '/v3.1/Contacts';
    protected array $required = ['id'];
    protected array $bodyParams = ['id' => 'CONTACT_ID', 'FIRST_NAME', 'LAST_NAME', 'EMAIL_ADDRESS', 'PHONE', 'PHONE_MOBILE', 'TITLE', 'ORGANISATION_ID', 'CUSTOMFIELDS', 'LINKS'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly contact ID.'],
        'FIRST_NAME' => ['type' => 'string', 'description' => 'First name.'],
        'LAST_NAME' => ['type' => 'string', 'description' => 'Last name.'],
        'EMAIL_ADDRESS' => ['type' => 'string', 'description' => 'Primary email address.'],
        'PHONE' => ['type' => 'string', 'description' => 'Phone number.'],
        'PHONE_MOBILE' => ['type' => 'string', 'description' => 'Mobile number.'],
        'TITLE' => ['type' => 'string', 'description' => 'Job title.'],
        'ORGANISATION_ID' => ['type' => 'integer', 'description' => 'Linked organization ID.'],
        'CUSTOMFIELDS' => ['type' => 'array', 'description' => 'Insightly custom field values.'],
        'LINKS' => ['type' => 'array', 'description' => 'Relationship links.'],
    ];
}
