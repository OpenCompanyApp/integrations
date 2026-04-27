<?php

namespace OpenCompany\Integrations\Aws;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Aws\Tools\AwsGetCloudwatchMetrics;
use OpenCompany\Integrations\Aws\Tools\AwsGetCurrentUser;
use OpenCompany\Integrations\Aws\Tools\AwsInvokeLambda;
use OpenCompany\Integrations\Aws\Tools\AwsListDynamodbTables;
use OpenCompany\Integrations\Aws\Tools\AwsListEc2Instances;
use OpenCompany\Integrations\Aws\Tools\AwsListLambdaFunctions;
use OpenCompany\Integrations\Aws\Tools\AwsListS3Buckets;
use OpenCompany\Integrations\Aws\Tools\AwsListSnsTopics;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class AwsToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{

/**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'bearer_token',
            'legacy_auth_type' => 'oauth',
            'credential_mode' => 'stored_token',
            'setup_flows' =>
            [
              0 => 'manual_token',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'access_token',
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
          'compatibility' => [
            'web_setup_supported' => true,
            'web_runtime_supported' => true,
            'cli_setup_supported' => true,
            'cli_runtime_supported' => true,
          ],
        ];
    }

    /**
     * Get the unique app name identifier.
     *
     * @return string The app name used for tool routing and namespacing.
     */
    public function appName(): string
    {
        return 'aws';
    }    /**
     * Get the configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>> The config field definitions.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your AWS access token',
                'hint' => 'Provide a Bearer token for authenticating with the AWS API',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://api.aws.amazon.com',
                'hint' => 'Override the default AWS API base URL (e.g., for a proxy or mock server)',
                'default' => 'https://api.aws.amazon.com',
            ],
        ];
    }

    /**
     * Test the connection to the AWS API using the provided configuration.
     *
     * @param  array<string, mixed>  $config  The configuration values to test.
     * @return array{success: bool, message?: string, error?: string} The test result.
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.aws.amazon.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/iam/user');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to AWS API at {$baseUrl}.",
                ];
            }

            return [
                'success' => false,
                'error' => "AWS API returned status {$response->status()}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get Laravel validation rules for the configuration fields.
     *
     * @return array<string, string> The validation rules.
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}> The tool definitions.
     */
    public function tools(): array
    {
        return [
            'aws_list_s3_buckets' => [
                'class' => AwsListS3Buckets::class,
                'type' => 'read',
                'name' => 'List S3 Buckets',
                'description' => 'List all S3 buckets in the AWS account.',
                'icon' => 'ph:bucket',
            ],
            'aws_list_ec2_instances' => [
                'class' => AwsListEc2Instances::class,
                'type' => 'read',
                'name' => 'List EC2 Instances',
                'description' => 'Describe EC2 instances with optional filtering.',
                'icon' => 'ph:computer',
            ],
            'aws_list_lambda_functions' => [
                'class' => AwsListLambdaFunctions::class,
                'type' => 'read',
                'name' => 'List Lambda Functions',
                'description' => 'List all Lambda functions.',
                'icon' => 'ph:lightning',
            ],
            'aws_invoke_lambda' => [
                'class' => AwsInvokeLambda::class,
                'type' => 'write',
                'name' => 'Invoke Lambda',
                'description' => 'Invoke a Lambda function with a payload.',
                'icon' => 'ph:play',
            ],
            'aws_list_dynamodb_tables' => [
                'class' => AwsListDynamodbTables::class,
                'type' => 'read',
                'name' => 'List DynamoDB Tables',
                'description' => 'List all DynamoDB tables.',
                'icon' => 'ph:database',
            ],
            'aws_get_cloudwatch_metrics' => [
                'class' => AwsGetCloudwatchMetrics::class,
                'type' => 'read',
                'name' => 'Get CloudWatch Metrics',
                'description' => 'Get CloudWatch metric data for monitoring.',
                'icon' => 'ph:chart-bar',
            ],
            'aws_list_sns_topics' => [
                'class' => AwsListSnsTopics::class,
                'type' => 'read',
                'name' => 'List SNS Topics',
                'description' => 'List all SNS notification topics.',
                'icon' => 'ph:bell',
            ],
            'aws_get_current_user' => [
                'class' => AwsGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current IAM user identity.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Get the path to supplementary Lua documentation.
     *
     * @return string|null The absolute path to the Lua docs markdown file, or null.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/aws.md';
    }

    /**
     * Get the credential fields required by this integration.
     *
     * @return array<int, array<string, mixed>> The credential field definitions.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => 'https://api.aws.amazon.com'],
        ];
    }

    /**
     * Whether this provider exposes toggleable integrations per agent.
     *
     * @return bool Always true for AWS.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, supporting multi-account via context.
     *
     * When an account is specified in the context, credentials are resolved
     * for that specific account. Otherwise, the container singleton is used.
     *
     * @param  string  $class  The fully-qualified tool class name.
     * @param  array<string, mixed>  $context  Runtime context (e.g., account, agent, timezone).
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new AwsService(
                accessToken: $creds->get('aws', 'access_token', '', $account),
                baseUrl: $creds->get('aws', 'base_url', 'https://api.aws.amazon.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(AwsService::class));
    }
}
