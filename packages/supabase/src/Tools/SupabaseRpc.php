<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a Supabase remote procedure (RPC function).
 */
class SupabaseRpc implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase API client
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_rpc';
    }

    public function description(): string
    {
        return <<<'MD'
        Call a remote procedure (RPC function) defined in the Supabase database.
        Provide the function name and a JSON object of parameters.
        MD;
    }

    public function parameters(): array
    {
        return [
            'function_name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the RPC function to call.'],
            'params' => ['type' => 'string', 'description' => 'JSON object of parameters to pass to the function.'],
        ];
    }

    /**
     * Call a remote procedure with the given parameters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (function_name, params)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Supabase integration is not configured.');
            }

            $functionName = $args['function_name'] ?? '';
            if (empty($functionName)) {
                return ToolResult::error('function_name is required.');
            }

            $params = [];
            if (isset($args['params'])) {
                $raw = $args['params'];
                if (is_string($raw)) {
                    $decoded = json_decode($raw, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        return ToolResult::error('Invalid JSON in params: ' . json_last_error_msg());
                    }
                    $params = $decoded;
                } elseif (is_array($raw)) {
                    $params = $raw;
                }
            }

            $result = $this->service->rpc($functionName, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
