<?php

namespace OpenCompany\Integrations\Square;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Square\Tools\SquareCreateCustomer;
use OpenCompany\Integrations\Square\Tools\SquareCreatePayment;
use OpenCompany\Integrations\Square\Tools\SquareGetCurrentUser;
use OpenCompany\Integrations\Square\Tools\SquareGetPayment;
use OpenCompany\Integrations\Square\Tools\SquareListCustomers;
use OpenCompany\Integrations\Square\Tools\SquareListLocations;
use OpenCompany\Integrations\Square\Tools\SquareListPayments;

class SquareToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'square';
    }

    /**
     * Get metadata for the app display.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'payments, customers, locations',
            'description' => 'Payments and POS platform',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:square',
        ];
    }

    /**
     * Get integration metadata for display in the integrations UI.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Square',
            'description' => 'Payments and POS platform for businesses',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:square',
            'category' => 'finance',
            'badge' => 'verified',
            'docs_url' => 'https://developer.squareup.com/docs/payments-api',
        ];
    }

    /**
     * Get the configuration schema for the Square integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Square access token',
                'hint' => 'Generate an access token in the Square Developer Dashboard under Credentials',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://connect.squareup.com/v2',
                'hint' => 'Use the default Square API URL, or a sandbox URL like <code>https://connect.squareupsandbox.com/v2</code> for testing',
                'default' => 'https://connect.squareup.com/v2',
            ],
        ];
    }

    /**
     * Test the connection to the Square API.
     *
     * @param  array<string, mixed>  $config  Configuration values
     * @return array<string, mixed>  Result with success/error keys
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://connect.squareup.com/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'Square-Version' => '2024-12-18',
            ])->timeout(10)->get($baseUrl . '/locations');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Square API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $errors = $json['errors'] ?? [];
                $errorMsg = !empty($errors) ? ($errors[0]['detail'] ?? $errors[0]['message'] ?? 'Unknown error') : "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "Square API error: {$errorMsg}",
                ];
            }

            $locationCount = count($json['locations'] ?? []);
            $locationName = $json['locations'][0]['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Square API — {$locationCount} location(s) found ({$locationName}).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'square_list_payments' => [
                'class' => SquareListPayments::class,
                'type' => 'read',
                'name' => 'List Payments',
                'description' => 'List payments with optional filtering by date, location, and status.',
                'icon' => 'ph:list-bullets',
            ],
            'square_get_payment' => [
                'class' => SquareGetPayment::class,
                'type' => 'read',
                'name' => 'Get Payment',
                'description' => 'Get details of a specific payment by ID.',
                'icon' => 'ph:credit-card',
            ],
            'square_create_payment' => [
                'class' => SquareCreatePayment::class,
                'type' => 'write',
                'name' => 'Create Payment',
                'description' => 'Create a new payment with a payment source.',
                'icon' => 'ph:plus-circle',
            ],
            'square_list_customers' => [
                'class' => SquareListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List customer profiles.',
                'icon' => 'ph:users',
            ],
            'square_create_customer' => [
                'class' => SquareCreateCustomer::class,
                'type' => 'write',
                'name' => 'Create Customer',
                'description' => 'Create a new customer profile.',
                'icon' => 'ph:user-plus',
            ],
            'square_list_locations' => [
                'class' => SquareListLocations::class,
                'type' => 'read',
                'name' => 'List Locations',
                'description' => 'List all business locations.',
                'icon' => 'ph:map-pin',
            ],
            'square_get_current_user' => [
                'class' => SquareGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Health check — returns the first location name to verify connectivity.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return null;
    }

    /**
     * Get the credential fields for this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Square API URL', 'required' => false, 'default' => 'https://connect.squareup.com/v2'],
        ];
    }

    /**
     * Confirm this is an integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with the given context.
     *
     * @param  string  $class  Fully-qualified tool class name
     * @param  array<string, mixed>  $context  Context with optional 'account' key
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new SquareService(
                accessToken: $creds->get('square', 'access_token', '', $account),
                baseUrl: $creds->get('square', 'url', 'https://connect.squareup.com/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(SquareService::class));
    }
}
