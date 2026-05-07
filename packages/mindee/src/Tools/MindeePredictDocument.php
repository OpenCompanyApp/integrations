<?php

namespace OpenCompany\Integrations\Mindee\Tools;

use RuntimeException;

/**
 * Run synchronous prediction against any Mindee product endpoint.
 */
class MindeePredictDocument extends AbstractMindeeTool
{
    public function name(): string
    {
        return 'mindee_predict_document';
    }

    public function description(): string
    {
        return 'Parse a document synchronously with any Mindee product endpoint using account, api_name, and api_version.';
    }

    public function parameters(): array
    {
        return [
            'account' => ['type' => 'string', 'required' => true, 'description' => 'Mindee account name, usually "mindee" for off-the-shelf APIs.'],
            'api_name' => ['type' => 'string', 'required' => true, 'description' => 'Mindee API name such as invoices or expense_receipts.'],
            'api_version' => ['type' => 'string', 'required' => true, 'description' => 'Mindee API version such as v4, v5, or v1.'],
            'document' => ['type' => 'string', 'required' => true, 'description' => 'File path, URL, or base64-encoded document content.'],
            'file_name' => ['type' => 'string', 'description' => 'Optional filename for multipart or base64 uploads.'],
            'options' => ['type' => 'object', 'description' => 'Additional query parameters for the Mindee endpoint.'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        foreach (['account', 'api_name', 'api_version', 'document'] as $key) {
            if (empty($args[$key])) {
                throw new RuntimeException("{$key} is required.");
            }
        }

        return $this->service->predictProduct(
            (string) $args['account'],
            (string) $args['api_name'],
            (string) $args['api_version'],
            (string) $args['document'],
            $args['file_name'] ?? null,
            $this->options($args),
        );
    }
}
