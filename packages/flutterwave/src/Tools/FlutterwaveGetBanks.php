<?php

namespace OpenCompany\Integrations\Flutterwave\Tools;

use OpenCompany\Integrations\Flutterwave\FlutterwaveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List banks supported by Flutterwave for a country.
 *
 * Requires an ISO country code such as NG, KE, GH, or ZA.
 */
class FlutterwaveGetBanks implements Tool
{
    /**
     * Create a new FlutterwaveGetBanks tool instance.
     *
     * @param  FlutterwaveService  $service  The Flutterwave service used to make API calls.
     */
    public function __construct(
        private FlutterwaveService $service,
    ) {}

    /**
     * The unique tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'flutterwave_get_banks';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get a list of supported banks for a given country from Flutterwave. Provide a country code like "NG" for Nigeria, "KE" for Kenya, "GH" for Ghana.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array{type: string, description: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'country' => ['type' => 'string', 'description' => 'ISO country code (e.g. "NG", "KE", "GH", "ZA").', 'required' => true],
        ];
    }

    /**
     * Execute the tool: fetch banks for a country from Flutterwave.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Flutterwave integration is not configured.');
            }

            if (empty($args['country'])) {
                return ToolResult::error('The "country" parameter is required (e.g. "NG").');
            }

            $result = $this->service->getBanks($args['country']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
