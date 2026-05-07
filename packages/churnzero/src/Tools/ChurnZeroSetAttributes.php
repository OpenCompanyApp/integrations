<?php

namespace OpenCompany\Integrations\ChurnZero\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ChurnZero\ChurnZeroService;

/**
 * Set one or more ChurnZero account or contact attributes.
 *
 * Uses ChurnZero setAttribute actions with accountExternalId and optional
 * contactExternalId identifiers from the source system.
 */
class ChurnZeroSetAttributes implements Tool
{
    /**
     * @param  ChurnZeroService  $service  The ChurnZero HTTP API client.
     */
    public function __construct(
        private ChurnZeroService $service,
    ) {}

    public function name(): string
    {
        return 'churnzero_set_attributes';
    }

    public function description(): string
    {
        return 'Set one or more ChurnZero account or contact attributes. For contacts, provide both account_external_id and contact_external_id. Attribute names must already exist in ChurnZero where required.';
    }

    public function parameters(): array
    {
        return [
            'entity' => ['type' => 'string', 'required' => true, 'enum' => ['account', 'contact'], 'description' => 'Whether to update an account or contact attribute.'],
            'account_external_id' => ['type' => 'string', 'required' => true, 'description' => 'Account identifier from your source system.'],
            'contact_external_id' => ['type' => 'string', 'description' => 'Contact identifier from your source system. Required when entity is contact.'],
            'attributes' => [
                'type' => 'object',
                'required' => true,
                'description' => 'Attribute name/value pairs to set in ChurnZero.',
            ],
        ];
    }

    /**
     * Set ChurnZero attributes.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ChurnZero integration is not configured.');
            }

            $attributes = $args['attributes'] ?? [];
            if (! is_array($attributes) || $attributes === []) {
                return ToolResult::error('attributes must be a non-empty object.');
            }

            $result = $this->service->setAttributes(
                (string) $args['entity'],
                (string) $args['account_external_id'],
                isset($args['contact_external_id']) ? (string) $args['contact_external_id'] : null,
                $attributes,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
