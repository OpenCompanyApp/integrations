<?php

namespace OpenCompany\Integrations\Prismic\Tools;

use OpenCompany\Integrations\Prismic\PrismicService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PrismicGetDocument implements Tool
{
    /**
     * Create a new PrismicGetDocument tool instance.
     */
    public function __construct(
        private PrismicService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'prismic_get_document';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Retrieve a single document from the Prismic repository by its unique document ID.';
    }

    /**
     * Get the tool parameters schema.
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique document ID (e.g., "YjRHVhAAACEAnFqZ").'],
            'ref' => ['type' => 'string', 'description' => 'The ref (release/draft) ID to query. Defaults to the master ref.'],
            'lang' => ['type' => 'string', 'description' => 'Language code to retrieve a specific translation (e.g., "en-us", "fr-fr").'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Prismic integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Document ID is required.');
            }

            $params = [
                'q' => '[[:d = at(document.id, "' . $id . '")]]',
            ];

            if (isset($args['ref'])) {
                $params['ref'] = $args['ref'];
            }
            if (isset($args['lang'])) {
                $params['lang'] = $args['lang'];
            }

            $result = $this->service->searchDocuments($params);

            $documents = $result['results'] ?? [];
            if (empty($documents)) {
                return ToolResult::error("Document with ID \"{$id}\" not found.");
            }

            return ToolResult::success($documents[0]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
