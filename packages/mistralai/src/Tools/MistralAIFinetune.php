<?php

namespace OpenCompany\Integrations\MistralAI\Tools;

use OpenCompany\Integrations\MistralAI\MistralAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for creating fine-tuning jobs on MistralAI.
 *
 * Submits a fine-tuning job that trains a custom model on provided training data.
 * The job runs asynchronously — use the returned job ID to track progress.
 */
class MistralAIFinetune implements Tool
{
    /**
     * Create a new MistralAIFinetune tool instance.
     */
    public function __construct(
        private MistralAIService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'mistralai_finetune';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Create a fine-tuning job on MistralAI. Upload training data and select a base model to create a custom fine-tuned model. The job runs asynchronously — check the returned job ID for status updates.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'model' => ['type' => 'string', 'required' => true, 'description' => 'The base model to fine-tune (e.g., "open-mistral-7b", "open-mixtral-8x7b").'],
            'training_files' => ['type' => 'array', 'required' => true, 'description' => 'Array of training file IDs (previously uploaded to MistralAI).'],
            'hyperparameters' => ['type' => 'string', 'description' => 'JSON-encoded hyperparameters object (e.g., {"n_epochs": 3, "learning_rate": 0.0001}).'],
            'suffix' => ['type' => 'string', 'description' => 'Suffix for the fine-tuned model name.'],
        ];
    }

    /**
     * Execute the fine-tuning job creation request.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MistralAI integration is not configured.');
            }

            $body = [
                'model' => $args['model'],
                'training_files' => $args['training_files'],
            ];

            if (isset($args['hyperparameters'])) {
                $hyperparams = $args['hyperparameters'];
                $body['hyperparameters'] = is_string($hyperparams) ? json_decode($hyperparams, true) : $hyperparams;
            }

            if (isset($args['suffix'])) {
                $body['suffix'] = $args['suffix'];
            }

            $result = $this->service->finetune($body);

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'object' => $result['object'] ?? 'fine_tuning.job',
                'model' => $result['model'] ?? $args['model'],
                'status' => $result['status'] ?? 'pending',
                'fine_tuned_model' => $result['fine_tuned_model'] ?? null,
                'created_at' => $result['created_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
