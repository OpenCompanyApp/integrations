<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Create an Insightly organization.
 */
class InsightlyCreateOrganization extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_create_organization';
    protected string $toolDescription = 'Create an Insightly organization.';
    protected string $method = 'POST';
    protected string $path = '/v3.1/Organisations';
    protected array $required = ['ORGANISATION_NAME'];
    protected array $bodyParams = ['ORGANISATION_NAME', 'BACKGROUND', 'WEBSITE', 'PHONE', 'ADDRESS_BILLING', 'ADDRESS_SHIPPING', 'CUSTOMFIELDS', 'LINKS'];
    protected array $parameters = [
        'ORGANISATION_NAME' => ['type' => 'string', 'required' => true, 'description' => 'Organization name.'],
        'BACKGROUND' => ['type' => 'string', 'description' => 'Background notes.'],
        'WEBSITE' => ['type' => 'string', 'description' => 'Website URL.'],
        'PHONE' => ['type' => 'string', 'description' => 'Phone number.'],
        'ADDRESS_BILLING' => ['type' => 'object', 'description' => 'Billing address object.'],
        'ADDRESS_SHIPPING' => ['type' => 'object', 'description' => 'Shipping address object.'],
        'CUSTOMFIELDS' => ['type' => 'array', 'description' => 'Custom field values.'],
        'LINKS' => ['type' => 'array', 'description' => 'Relationship links.'],
    ];
}
