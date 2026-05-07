<?php

namespace OpenCompany\Integrations\GoogleDriveActivity\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\GoogleDriveActivity\{GoogleDriveActivityService};

/**
 * Shared executor for Google Drive Activity endpoint-specific tools.
 *
 * Handles configured-state checks, body shaping, and error conversion.
 */
abstract class AbstractGoogleDriveActivityTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const BODY_REQUIRED = false;

    /**
     * @param  GoogleDriveActivityService  $service  Google Drive Activity API client.
     */
    public function __construct(protected GoogleDriveActivityService $service) {}

    public function name(): string { return static::NAME; }
    public function description(): string { return static::DESCRIPTION; }
    public function parameters(): array { return static::PARAMETERS; }

    /**
     * Execute the mapped Google Drive Activity REST method.
     *
     * @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) return ToolResult::error('Google Drive Activity integration is not configured.');
            return ToolResult::success($this->service->queryActivity($this->body($args)));
        } catch (\Throwable $e) { return ToolResult::error($e->getMessage()); }
    }

    /**
     * Extract the official JSON request body from tool arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function body(array $args): array
    {
        $body = $args['body'] ?? [];

        if ($body !== [] && !is_array($body)) {
            throw new InvalidArgumentException('body must be an object.');
        }

        foreach (['item_name' => 'itemName', 'ancestor_name' => 'ancestorName', 'page_size' => 'pageSize', 'page_token' => 'pageToken', 'filter' => 'filter'] as $argument => $field) {
            if (array_key_exists($argument, $args) && $args[$argument] !== null && $args[$argument] !== '') {
                $body[$field] = $args[$argument];
            }
        }

        if (isset($args['consolidation_strategy'])) {
            $strategy = $args['consolidation_strategy'];
            if (!is_array($strategy)) {
                throw new InvalidArgumentException('consolidation_strategy must be an object.');
            }
            foreach (['legacy', 'none'] as $emptyObjectField) {
                if (array_key_exists($emptyObjectField, $strategy) && $strategy[$emptyObjectField] === []) {
                    $strategy[$emptyObjectField] = new \stdClass();
                }
            }
            $body['consolidationStrategy'] = $strategy;
        }

        if (static::BODY_REQUIRED && $body === []) {
            throw new InvalidArgumentException('Provide item_name, ancestor_name, filter, or body matching the Google Drive Activity QueryDriveActivityRequest schema.');
        }

        return $body;
    }
}
