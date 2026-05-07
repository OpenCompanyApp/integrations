<?php

namespace OpenCompany\Integrations\Square;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Square\Tools\SquareCreateCustomer;
use OpenCompany\Integrations\Square\Tools\SquareCreatePayment;
use OpenCompany\Integrations\Square\Tools\SquareGetCurrentUser;
use OpenCompany\Integrations\Square\Tools\SquareGetCustomer;
use OpenCompany\Integrations\Square\Tools\SquareGetOrder;
use OpenCompany\Integrations\Square\Tools\SquareGetPayment;
use OpenCompany\Integrations\Square\Tools\SquareListCustomers;
use OpenCompany\Integrations\Square\Tools\SquareListLocations;
use OpenCompany\Integrations\Square\Tools\SquareListOrders;
use OpenCompany\Integrations\Square\Tools\SquareListPayments;
/**
 * Registers Square tools and metadata for integration discovery.
 *
 * Exposes merchant, location, payment, customer, and order operations for the
 * Square REST API.
 */
class SquareToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'bearer_token',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['Square access tokens are sent as Authorization: Bearer <access_token>.'],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [],
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
        return 'square';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Square',
            'description' => 'Square payments and POS',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:square',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Square',
            'description' => 'Payment processing, point of sale, customer management, and orders',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:square',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://developer.squareup.com/reference/square',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'EAAAEO...',
                'hint' => 'Find in Square Developer Dashboard → Credentials. Use a sandbox token for testing or a production token for live data.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided. Find yours at Square Developer Dashboard → Credentials.'];
        }

        try {
            $response = Http::withToken($accessToken)
                ->withHeaders(['Square-Version' => '2024-12-18'])
                ->timeout(10)
                ->get('https://api.squareup.com/v2/merchants/me');

            if ($response->successful()) {
                $data = $response->json() ?? [];
                $merchant = $data['merchant'] ?? [];
                $name = $merchant['business_name'] ?? ($merchant['id'] ?? 'Unknown');

                return [
                    'success' => true,
                    'message' => "Connected to Square as \"{$name}\".",
                ];
            }

            $errors = $response->json('errors') ?? [];
            $errorMessages = array_map(function (array $e) {
                return $e['detail'] ?? ($e['message'] ?? 'Unknown error');
            }, $errors);

            $combined = ! empty($errorMessages)
                ? implode('; ', $errorMessages)
                : $response->body();

            return [
                'success' => false,
                'error' => 'Square API error (' . $response->status() . '): ' . $combined,
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'square_get_current_user' => [
                'class' => SquareGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated Square merchant account. Returns merchant details including business name, country, currency, and status.',
                'icon' => 'ph:wrench',
            ],
            'square_get_customer' => [
                'class' => SquareGetCustomer::class,
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Retrieve a Square customer by ID. Returns full customer details including email, phone, address, and cards on file.',
                'icon' => 'ph:wrench',
            ],
            'square_get_order' => [
                'class' => SquareGetOrder::class,
                'type' => 'read',
                'name' => 'Get Order',
                'description' => 'Retrieve a Square order by ID. Returns full order details including line items, totals, taxes, and discounts.',
                'icon' => 'ph:wrench',
            ],
            'square_get_payment' => [
                'class' => SquareGetPayment::class,
                'type' => 'read',
                'name' => 'Get Payment',
                'description' => 'Retrieve a Square payment by ID. Returns full payment details including amount, status, card details, and processing fees.',
                'icon' => 'ph:wrench',
            ],
            'square_create_payment' => [
                'class' => SquareCreatePayment::class,
                'type' => 'write',
                'name' => 'Create Payment',
                'description' => 'Create a Square payment from a source ID, amount, currency, and idempotency key.',
                'icon' => 'ph:credit-card',
            ],
            'square_list_customers' => [
                'class' => SquareListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List Square customers with optional filtering. Supports pagination with cursor.',
                'icon' => 'ph:wrench',
            ],
            'square_create_customer' => [
                'class' => SquareCreateCustomer::class,
                'type' => 'write',
                'name' => 'Create Customer',
                'description' => 'Create a Square customer profile.',
                'icon' => 'ph:user-plus',
            ],
            'square_list_orders' => [
                'class' => SquareListOrders::class,
                'type' => 'read',
                'name' => 'List Orders',
                'description' => 'List Square orders for a specific location. Requires a location_id. Supports filtering by order states and pagination with cursor.',
                'icon' => 'ph:wrench',
            ],
            'square_list_payments' => [
                'class' => SquareListPayments::class,
                'type' => 'read',
                'name' => 'List Payments',
                'description' => 'List Square payments with optional filtering. Supports filtering by location ID, begin_time / end_time (ISO 8601), and pagination with cursor.',
                'icon' => 'ph:wrench',
            ],
            'square_list_locations' => [
                'class' => SquareListLocations::class,
                'type' => 'read',
                'name' => 'List Locations',
                'description' => 'List Square business locations.',
                'icon' => 'ph:map-pin',
            ],
        ];
    }


    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/square.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
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
     * Resolve the SquareService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): SquareService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new SquareService(
                accessToken: $creds->get('square', 'access_token', '', $account),
            );
        }

        return app(SquareService::class);
    }
}
