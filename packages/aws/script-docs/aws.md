# AWS — Ruby API Reference

## list_s3_buckets

List all S3 buckets in the AWS account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `region` | string | no | AWS region to query (e.g., `"us-east-1"`) |

### Example

```ruby
result = app.integrations.aws.list_s3_buckets()
(result.buckets || []).each do |bucket|
  puts((bucket.name).to_s + " (" + (bucket.region).to_s + ")")
end
```
---

## list_ec2_instances

Describe EC2 instances with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `instance_ids` | array | no | List of instance IDs to describe (e.g., `{"i-1234567890abcdef0"}`) |
| `filters` | array | no | Filters to apply (e.g., `{{Name = "instance-state-name", Values = {"running"}}}`) |
| `region` | string | no | AWS region to query |

### Examples

```ruby
# List all running instances
result = app.integrations.aws.list_ec2_instances(filters: [{Name: "instance-state-name", Values: ["running"]}])
# List specific instances
result = app.integrations.aws.list_ec2_instances(instance_ids: ["i-1234567890abcdef0", "i-0987654321fedcba0"])
```
---

## list_lambda_functions

List all Lambda functions.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `max_items` | integer | no | Maximum number of functions to return (default: 50) |
| `region` | string | no | AWS region to query |

### Example

```ruby
result = app.integrations.aws.list_lambda_functions(max_items: 20)
(result.functions || []).each do |fn|
  puts((fn.name).to_s + " (" + (fn.runtime).to_s + ")")
end
```
---

## invoke_lambda

Invoke a Lambda function with an optional payload.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `function_name` | string | yes | Name or ARN of the Lambda function |
| `payload` | object | no | JSON payload to pass to the function |
| `invocation_type` | string | no | `"RequestResponse"` (sync, default), `"Event"` (async), or `"DryRun"` |
| `region` | string | no | AWS region |

### Examples

```ruby
# Synchronous invocation
result = app.integrations.aws.invoke_lambda(function_name: "my-function", payload: {key: "value"}, invocation_type: "RequestResponse")
puts(result.status_code, result.payload)
# Async invocation (fire and forget)
result = app.integrations.aws.invoke_lambda(function_name: "my-function", payload: {event: "trigger"}, invocation_type: "Event")
```
---

## list_dynamodb_tables

List all DynamoDB tables.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of table names to return (default: 100) |
| `exclusive_start_table_name` | string | no | Pagination token — table name to start from |
| `region` | string | no | AWS region to query |

### Example

```ruby
result = app.integrations.aws.list_dynamodb_tables()
(result.table_names || []).each do |name|
  puts(name)
end
```
---

## get_cloudwatch_metrics

Get CloudWatch metric data for AWS resources.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `namespace` | string | yes | CloudWatch namespace (e.g., `"AWS/EC2"`, `"AWS/Lambda"`) |
| `metric_name` | string | yes | Metric name (e.g., `"CPUUtilization"`, `"Invocations"`) |
| `statistics` | array | yes | Statistics to retrieve (e.g., `{"Average", "Maximum"}`) |
| `start_time` | string | yes | Start time (ISO 8601, e.g., `"2026-01-01T00:00:00Z"`) |
| `end_time` | string | yes | End time (ISO 8601, e.g., `"2026-01-02T00:00:00Z"`) |
| `period` | integer | no | Granularity in seconds (60, 300, 3600). Default: 300 |
| `dimensions` | array | no | Dimensions to filter by |
| `region` | string | no | AWS region |

### Examples

```ruby
# EC2 CPU utilization (last hour, 5-minute periods)
result = app.integrations.aws.get_cloudwatch_metrics(namespace: "AWS/EC2", metric_name: "CPUUtilization", statistics: ["Average", "Maximum"], start_time: "2026-04-05T00:00:00Z", end_time: "2026-04-05T01:00:00Z", period: 300, dimensions: [{Name: "InstanceId", Value: "i-1234567890abcdef0"}])
# Lambda invocation count
result = app.integrations.aws.get_cloudwatch_metrics(namespace: "AWS/Lambda", metric_name: "Invocations", statistics: ["Sum"], start_time: "2026-04-04T00:00:00Z", end_time: "2026-04-05T00:00:00Z", period: 3600)
```
---

## list_sns_topics

List all SNS notification topics.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `next_token` | string | no | Pagination token from a previous response |
| `region` | string | no | AWS region to query |

### Example

```ruby
result = app.integrations.aws.list_sns_topics()
(result.topics || []).each do |topic|
  puts(topic.topic_arn)
end
```
---

## get_current_user

Get the current IAM user identity.

### Parameters

None.

### Example

```ruby
result = app.integrations.aws.get_current_user()
puts("User ARN: " + (result.user.arn).to_s)
puts("Account ID: " + (result.user.account_id).to_s)
puts("User ID: " + (result.user.user_id).to_s)
```
---

## Multi-Account Usage

If you have multiple AWS accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.aws.list_s3_buckets()
# Explicit default (portable across setups)
app.integrations.aws.default.list_s3_buckets()
# Named accounts
app.integrations.aws.production.list_s3_buckets()
app.integrations.aws.staging.list_ec2_instances()
```
All functions are identical across accounts — only the credentials differ.
