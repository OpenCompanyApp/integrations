<?php

namespace OpenCompany\Integrations\Cohere\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Upload a Cohere dataset file.
 *
 * Sends multipart data to the v1 Datasets API with documented query options.
 */
class CohereCreateDataset extends AbstractCohereTool implements Tool
{
    public function name(): string
    {
        return 'cohere_create_dataset';
    }

    public function description(): string
    {
        return 'Upload a dataset file to Cohere. For embed jobs, use type=embed-input and a JSONL/CSV/TXT file that matches Cohere dataset rules.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Dataset display name.'],
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Dataset type, for example embed-input.'],
            'filename' => ['type' => 'string', 'required' => true, 'description' => 'Filename for the uploaded dataset.'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'Raw dataset file content.'],
            'eval_filename' => ['type' => 'string', 'description' => 'Optional evaluation filename.'],
            'eval_content' => ['type' => 'string', 'description' => 'Optional evaluation file content.'],
            'keep_original_file' => ['type' => 'boolean', 'description' => 'Store the original uploaded file.'],
            'skip_malformed_input' => ['type' => 'boolean', 'description' => 'Drop malformed rows instead of failing validation.'],
            'keep_fields' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Required fields to preserve.'],
            'optional_fields' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Optional fields to preserve.'],
            'text_separator' => ['type' => 'string', 'description' => 'Separator for raw text uploads.'],
            'csv_delimiter' => ['type' => 'string', 'description' => 'Delimiter for CSV uploads.'],
        ];
    }

    /**
     * Execute the Cohere Create Dataset API call.
     *
     * @param  array<string, mixed>  $args  Multipart upload arguments and dataset query options.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cohere integration is not configured.');
            }

            $options = $this->only($args, [
                'name',
                'type',
                'keep_original_file',
                'skip_malformed_input',
                'keep_fields',
                'optional_fields',
                'text_separator',
                'csv_delimiter',
            ]);
            $options['name'] = $this->requireString($args, 'name');
            $options['type'] = $this->requireString($args, 'type');

            $evalFilename = isset($args['eval_filename']) ? $this->requireString($args, 'eval_filename') : null;
            $evalContent = isset($args['eval_content']) ? $this->requireString($args, 'eval_content') : null;
            if (($evalFilename === null) !== ($evalContent === null)) {
                return ToolResult::error('eval_filename and eval_content must be provided together.');
            }

            return ToolResult::success($this->service->createDataset(
                $this->requireString($args, 'filename'),
                $this->requireString($args, 'content'),
                $options,
                $evalFilename,
                $evalContent,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
