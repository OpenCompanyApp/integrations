<?php

namespace OpenCompany\Integrations\Snowflake\Tools;

use OpenCompany\Integrations\Snowflake\SnowflakeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SnowflakeExecuteQuery implements Tool
{
    public function __construct(
        private SnowflakeService $service,
    ) {}

    public function name(): string
    {
        return 'snowflake_execute_query';
    }

    public function description(): string
    {
        return 'Execute a SQL statement on Snowflake. Returns column metadata and result rows. Optionally specify warehouse, database, and schema context.';
    }

    public function parameters(): array
    {
        return [
            'sql' => ['type' => 'string', 'required' => true, 'description' => 'The SQL statement to execute (e.g., "SELECT * FROM my_table LIMIT 10").'],
            'warehouse' => ['type' => 'string', 'description' => 'The warehouse to use for the query (overrides default).'],
            'database' => ['type' => 'string', 'description' => 'The database context for the query.'],
            'schema' => ['type' => 'string', 'description' => 'The schema context for the query.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Snowflake integration is not configured.');
            }

            $result = $this->service->executeQuery(
                sql: $args['sql'],
                warehouse: $args['warehouse'] ?? null,
                database: $args['database'] ?? null,
                schema: $args['schema'] ?? null,
            );

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the Snowflake SQL API response into a structured result.
     *
     * @param  array<string, mixed>  $result
     * @return array<string, mixed>
     */
    private function formatResponse(array $result): array
    {
        $response = [];

        if (isset($result['statementHandle'])) {
            $response['statementHandle'] = $result['statementHandle'];
        }

        // Extract column metadata
        $resultSet = $result['resultSetMetaData'] ?? null;
        if ($resultSet !== null) {
            $columns = [];
            foreach ($resultSet['rowType'] ?? [] as $col) {
                $columns[] = [
                    'name' => $col['name'] ?? '',
                    'type' => $col['type'] ?? '',
                    'nullable' => $col['nullable'] ?? null,
                    'precision' => $col['precision'] ?? null,
                    'scale' => $col['scale'] ?? null,
                ];
            }
            $response['columns'] = $columns;
            $response['totalRows'] = $resultSet['totalRows'] ?? count($result['data'] ?? []);
        }

        // Extract data rows
        $data = $result['data'] ?? [];
        if (!empty($data) && !empty($response['columns'])) {
            $colNames = array_map(fn (array $col): string => $col['name'], $response['columns']);
            $rows = [];
            foreach ($data as $row) {
                $entry = [];
                foreach ($colNames as $i => $name) {
                    $entry[$name] = $row[$i] ?? null;
                }
                $rows[] = $entry;
            }
            $response['rows'] = $rows;
            $response['rowCount'] = count($rows);
        }

        if (isset($result['sqlState'])) {
            $response['sqlState'] = $result['sqlState'];
        }

        return $response;
    }
}
