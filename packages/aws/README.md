# Integration: AWS

> AWS cloud integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage S3 buckets, EC2 instances, Lambda functions, DynamoDB tables, CloudWatch metrics, SNS topics, and IAM users. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your AWS cloud infrastructure. List and manage S3 buckets, query EC2 instances, invoke Lambda functions, scan DynamoDB tables, pull CloudWatch metrics, browse SNS topics, and check IAM user context — all through the AWS API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This AWS tool lets AI agents query and manage cloud infrastructure — giving agents visibility into your AWS resources for monitoring, debugging, and operational tasks.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-aws
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an AWS access token (Bearer token).

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'aws' => [
        'access_token' => env('AWS_ACCESS_TOKEN'),
        'base_url'     => env('AWS_BASE_URL', 'https://api.aws.amazon.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `aws_list_s3_buckets` | read | List all S3 buckets |
| `aws_list_ec2_instances` | read | Describe EC2 instances |
| `aws_list_lambda_functions` | read | List Lambda functions |
| `aws_invoke_lambda` | write | Invoke a Lambda function |
| `aws_list_dynamodb_tables` | read | List DynamoDB tables |
| `aws_get_cloudwatch_metrics` | read | Get CloudWatch metric data |
| `aws_list_sns_topics` | read | List SNS topics |
| `aws_get_current_user` | read | Get current IAM user |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Aws\AwsService;
use OpenCompany\Integrations\Aws\Tools\AwsListS3Buckets;
use OpenCompany\Integrations\Aws\Tools\AwsListEc2Instances;

// Create tools
$service = app(AwsService::class);
$tools = [
    new AwsListS3Buckets($service),
    new AwsListEc2Instances($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all S3 buckets in my AWS account');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('aws');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Aws\Tools\AwsListS3Buckets::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Aws\AwsService;

$service = app(AwsService::class);

// List S3 buckets
$buckets = $service->get('/s3/buckets');

// Describe EC2 instances
$instances = $service->post('/ec2/describe-instances');

// List Lambda functions
$functions = $service->get('/lambda/functions');

// Invoke a Lambda function
$result = $service->post('/lambda/functions/my-function/invocations', [
    'payload' => ['key' => 'value'],
]);
```

## Dependencies

| Package | Purpose |
|---------|---------|
| [opencompanyapp/integration-core](https://github.com/OpenCompanyApp/integration-core) | ToolProvider contract and registry |
| [laravel/ai](https://github.com/laravel/ai) | Laravel AI SDK Tool contract |

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- [Laravel AI SDK](https://github.com/laravel/ai) ^0.1
- An AWS account with API access

## License

MIT — see [LICENSE](LICENSE)
