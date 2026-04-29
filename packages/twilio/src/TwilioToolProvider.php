<?php

namespace OpenCompany\Integrations\Twilio;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Twilio\Tools\TwilioCreateUsageTrigger;
use OpenCompany\Integrations\Twilio\Tools\TwilioDeleteRecording;
use OpenCompany\Integrations\Twilio\Tools\TwilioGetAccount;
use OpenCompany\Integrations\Twilio\Tools\TwilioGetCall;
use OpenCompany\Integrations\Twilio\Tools\TwilioGetMessage;
use OpenCompany\Integrations\Twilio\Tools\TwilioGetPhoneNumber;
use OpenCompany\Integrations\Twilio\Tools\TwilioListCalls;
use OpenCompany\Integrations\Twilio\Tools\TwilioListMessages;
use OpenCompany\Integrations\Twilio\Tools\TwilioListPhoneNumbers;
use OpenCompany\Integrations\Twilio\Tools\TwilioListRecordings;
use OpenCompany\Integrations\Twilio\Tools\TwilioListUsageRecords;
use OpenCompany\Integrations\Twilio\Tools\TwilioLookupPhone;
use OpenCompany\Integrations\Twilio\Tools\TwilioMakeCall;
use OpenCompany\Integrations\Twilio\Tools\TwilioSendSms;
use OpenCompany\Integrations\Twilio\Tools\TwilioSendWhatsapp;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all Twilio tools and provides integration metadata.
 */
class TwilioToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

/**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'api_token',
            'legacy_auth_type' => 'api_token',
            'credential_mode' => 'secret',
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
          'compatibility' => [
            'web_setup_supported' => true,
            'web_runtime_supported' => true,
            'cli_setup_supported' => true,
            'cli_runtime_supported' => true,
          ],
        ];
    }

    public function appName(): string
    {
        return 'twilio';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Twilio',
            'description' => 'Cloud communications',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:twilio',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Twilio',
            'description' => 'SMS, voice calls, WhatsApp messaging, phone number management, and usage tracking',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:twilio',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://www.twilio.com/docs/usage/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'account_sid',
                'type' => 'text',
                'label' => 'Account SID',
                'placeholder' => 'ACxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
                'hint' => 'Find in Twilio Console → Dashboard → Account Info.',
                'required' => true,
            ],
            [
                'key' => 'auth_token',
                'type' => 'secret',
                'label' => 'Auth Token',
                'placeholder' => 'your_auth_token',
                'hint' => 'Find in Twilio Console → Dashboard → Account Info.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accountSid = $config['account_sid'] ?? '';
        $authToken = $config['auth_token'] ?? '';

        if (empty($accountSid) || empty($authToken)) {
            return ['success' => false, 'error' => 'Account SID and Auth Token are required. Find them in Twilio Console → Dashboard.'];
        }

        try {
            $response = Http::withBasicAuth($accountSid, $authToken)
                ->timeout(10)
                ->get("https://api.twilio.com/2010-04-01/Accounts/{$accountSid}.json");

            if ($response->successful()) {
                $account = $response->json() ?? [];
                $status = $account['status'] ?? 'unknown';
                $friendlyName = $account['friendly_name'] ?? $accountSid;

                return [
                    'success' => true,
                    'message' => "Connected to Twilio account \"{$friendlyName}\" (status: {$status}).",
                ];
            }

            $error = $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Twilio API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'account_sid' => 'nullable|string',
            'auth_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Messages
            'twilio_send_sms' => [
                'class' => TwilioSendSms::class,
                'type' => 'write',
                'name' => 'Send SMS',
                'description' => 'Send an SMS or MMS message via Twilio.',
                'icon' => 'ph:chat-text',
            ],
            'twilio_get_message' => [
                'class' => TwilioGetMessage::class,
                'type' => 'read',
                'name' => 'Get Message',
                'description' => 'Retrieve a Twilio message by SID.',
                'icon' => 'ph:chat-centered-text',
            ],
            'twilio_list_messages' => [
                'class' => TwilioListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List Twilio messages with optional filtering.',
                'icon' => 'ph:chats',
            ],
            // Calls
            'twilio_make_call' => [
                'class' => TwilioMakeCall::class,
                'type' => 'write',
                'name' => 'Make Call',
                'description' => 'Make an outbound voice call via Twilio.',
                'icon' => 'ph:phone-call',
            ],
            'twilio_get_call' => [
                'class' => TwilioGetCall::class,
                'type' => 'read',
                'name' => 'Get Call',
                'description' => 'Retrieve a Twilio call by SID.',
                'icon' => 'ph:phone',
            ],
            'twilio_list_calls' => [
                'class' => TwilioListCalls::class,
                'type' => 'read',
                'name' => 'List Calls',
                'description' => 'List Twilio calls with optional filtering.',
                'icon' => 'ph:list-dashes',
            ],
            // Phone Numbers
            'twilio_list_phone_numbers' => [
                'class' => TwilioListPhoneNumbers::class,
                'type' => 'read',
                'name' => 'List Phone Numbers',
                'description' => 'List incoming phone numbers on the Twilio account.',
                'icon' => 'ph:device-mobile',
            ],
            'twilio_get_phone_number' => [
                'class' => TwilioGetPhoneNumber::class,
                'type' => 'read',
                'name' => 'Get Phone Number',
                'description' => 'Retrieve a Twilio phone number by SID.',
                'icon' => 'ph:device-mobile',
            ],
            // Lookup
            'twilio_lookup_phone' => [
                'class' => TwilioLookupPhone::class,
                'type' => 'read',
                'name' => 'Lookup Phone',
                'description' => 'Lookup phone number details using Twilio Lookup API.',
                'icon' => 'ph:magnifying-glass',
            ],
            // Usage
            'twilio_create_usage_trigger' => [
                'class' => TwilioCreateUsageTrigger::class,
                'type' => 'write',
                'name' => 'Create Usage Trigger',
                'description' => 'Create a usage trigger on the Twilio account.',
                'icon' => 'ph:bell-ringing',
            ],
            'twilio_list_usage_records' => [
                'class' => TwilioListUsageRecords::class,
                'type' => 'read',
                'name' => 'List Usage Records',
                'description' => 'List Twilio usage records with optional filtering.',
                'icon' => 'ph:chart-bar',
            ],
            // WhatsApp
            'twilio_send_whatsapp' => [
                'class' => TwilioSendWhatsapp::class,
                'type' => 'write',
                'name' => 'Send WhatsApp',
                'description' => 'Send a WhatsApp message via Twilio.',
                'icon' => 'ph:whatsapp-logo',
            ],
            // Account
            'twilio_get_account' => [
                'class' => TwilioGetAccount::class,
                'type' => 'read',
                'name' => 'Get Account',
                'description' => 'Retrieve Twilio account details.',
                'icon' => 'ph:identification-badge',
            ],
            // Recordings
            'twilio_list_recordings' => [
                'class' => TwilioListRecordings::class,
                'type' => 'read',
                'name' => 'List Recordings',
                'description' => 'List Twilio call recordings.',
                'icon' => 'ph:waveform',
            ],
            'twilio_delete_recording' => [
                'class' => TwilioDeleteRecording::class,
                'type' => 'write',
                'name' => 'Delete Recording',
                'description' => 'Delete a Twilio recording by SID.',
                'icon' => 'ph:trash',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/twilio.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'account_sid', 'type' => 'text', 'label' => 'Account SID', 'required' => true],
            ['key' => 'auth_token', 'type' => 'secret', 'label' => 'Auth Token', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the TwilioService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): TwilioService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new TwilioService(
                accountSid: $creds->get('twilio', 'account_sid', '', $account),
                authToken: $creds->get('twilio', 'auth_token', '', $account),
            );
        }

        return app(TwilioService::class);
    }
}
