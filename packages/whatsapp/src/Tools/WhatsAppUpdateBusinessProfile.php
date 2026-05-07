<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update the WhatsApp business profile for the configured phone number.
 */
class WhatsAppUpdateBusinessProfile extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_update_business_profile';
    }

    public function description(): string
    {
        return 'Update the WhatsApp business profile fields for the configured phone number.';
    }

    public function parameters(): array
    {
        return [
            'profile' => ['type' => 'object', 'required' => true, 'description' => 'Business profile fields such as about, address, description, email, websites, vertical, and profile_picture_handle.'],
        ];
    }

    /**
     * Update the business profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(function () use ($args): array {
            $profile = $this->arrayArg($args, 'profile');
            if ($profile === []) {
                throw new \InvalidArgumentException('profile is required.');
            }

            return $this->service->updateBusinessProfile($profile);
        });
    }
}
