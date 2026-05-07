<?php

namespace OpenCompany\Integrations\HuggingFace\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\HuggingFace\HuggingFaceService;

/**
 * Create a model, dataset, or Space repository on Hugging Face.
 *
 * Passes supported Hub repository creation fields through to the official endpoint.
 */
class HuggingFaceCreateRepo implements Tool
{
    /**
     * @param  HuggingFaceService  $service  Hugging Face Hub API client.
     */
    public function __construct(
        private HuggingFaceService $service,
    ) {}

    public function name(): string
    {
        return 'huggingface_create_repo';
    }

    public function description(): string
    {
        return 'Create a Hugging Face model, dataset, or Space repository. Use type values "model", "dataset", or "space".';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Repository name without owner prefix.'],
            'type' => ['type' => 'string', 'required' => true, 'enum' => ['model', 'dataset', 'space'], 'description' => 'Repository type.'],
            'organization' => ['type' => 'string', 'description' => 'Optional organization owner. Omit for the authenticated user.'],
            'private' => ['type' => 'boolean', 'description' => 'Whether the repository should be private.'],
            'sdk' => ['type' => 'string', 'description' => 'Space SDK when creating a Space, for example "gradio", "streamlit", "docker", or "static".'],
            'license' => ['type' => 'string', 'description' => 'Optional license identifier.'],
            'extra' => ['type' => 'object', 'description' => 'Additional official repository creation fields to pass through.'],
        ];
    }

    /**
     * Create a repository on the Hugging Face Hub.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, type, organization, private, sdk, license, extra)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hugging Face integration is not configured.');
            }

            if (empty($args['name']) || empty($args['type'])) {
                return ToolResult::error('name and type are required.');
            }

            $payload = is_array($args['extra'] ?? null) ? $args['extra'] : [];
            foreach (['name', 'type', 'organization', 'private', 'sdk', 'license'] as $key) {
                if (array_key_exists($key, $args) && $args[$key] !== null && $args[$key] !== '') {
                    $payload[$key] = $args[$key];
                }
            }

            return ToolResult::success($this->service->createRepo($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
