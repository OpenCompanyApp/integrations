<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve the WhatsApp business profile for the configured phone number.
 */
class WhatsAppGetBusinessProfile extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_get_business_profile';
    }

    public function description(): string
    {
        return 'Get the WhatsApp business profile for the configured phone number.';
    }

    public function parameters(): array
    {
        return [
            'fields' => ['type' => 'string', 'description' => 'Comma-separated business profile fields.'],
        ];
    }

    /**
     * Get the business profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getBusinessProfile(
            $this->string($args, 'fields', 'about,address,description,email,profile_picture_url,websites,vertical'),
        ));
    }
}
