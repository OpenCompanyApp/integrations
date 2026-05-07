<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Update an Insightly organization.
 */
class InsightlyUpdateOrganization extends InsightlyCreateOrganization
{
    protected string $toolName = 'insightly_update_organization';
    protected string $toolDescription = 'Update an Insightly organization.';
    protected string $method = 'PUT';
    protected string $path = '/v3.1/Organisations';
    protected array $required = ['id'];
    protected array $bodyParams = ['id' => 'ORGANISATION_ID', 'ORGANISATION_NAME', 'BACKGROUND', 'WEBSITE', 'PHONE', 'ADDRESS_BILLING', 'ADDRESS_SHIPPING', 'CUSTOMFIELDS', 'LINKS'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly organization ID.'],
        'ORGANISATION_NAME' => ['type' => 'string', 'description' => 'Organization name.'],
        'BACKGROUND' => ['type' => 'string', 'description' => 'Background notes.'],
        'WEBSITE' => ['type' => 'string', 'description' => 'Website URL.'],
        'PHONE' => ['type' => 'string', 'description' => 'Phone number.'],
        'ADDRESS_BILLING' => ['type' => 'object', 'description' => 'Billing address object.'],
        'ADDRESS_SHIPPING' => ['type' => 'object', 'description' => 'Shipping address object.'],
        'CUSTOMFIELDS' => ['type' => 'array', 'description' => 'Custom field values.'],
        'LINKS' => ['type' => 'array', 'description' => 'Relationship links.'],
    ];
}
