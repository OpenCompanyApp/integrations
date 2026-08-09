# AWS — JavaScript API Reference

## list_s3_buckets

List all S3 buckets in the AWS account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `region` | string | no | AWS region to query (e.g., `"us-east-1"`) |

### Example

```js
var result = app.integrations.aws.list_s3_buckets({})
for (const bucket of (result.buckets || [])) {
  console.log(bucket.name + " (" + bucket.region + ")")
}
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

```js
// List all running instances
var result = app.integrations.aws.list_ec2_instances({
  filters: [{Name: "instance-state-name", Values: ["running"]}],
})

// List specific instances
var result = app.integrations.aws.list_ec2_instances({
  instance_ids: ["i-1234567890abcdef0", "i-0987654321fedcba0"],
})
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

```js
var result = app.integrations.aws.list_lambda_functions({max_items: 20})
for (const fn of (result.functions || [])) {
  console.log(fn.name + " (" + fn.runtime + ")")
}
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

```js
// Synchronous invocation
var result = app.integrations.aws.invoke_lambda({
  function_name: "my-function",
  payload: {key: "value"},
  invocation_type: "RequestResponse",
})
console.log(result.status_code, result.payload)

// Async invocation (fire and forget)
var result = app.integrations.aws.invoke_lambda({
  function_name: "my-function",
  payload: {event: "trigger"},
  invocation_type: "Event",
})
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

```js
var result = app.integrations.aws.list_dynamodb_tables({})
for (const name of (result.table_names || [])) {
  console.log(name)
}
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

```js
// EC2 CPU utilization (last hour, 5-minute periods)
var result = app.integrations.aws.get_cloudwatch_metrics({
  namespace: "AWS/EC2",
  metric_name: "CPUUtilization",
  statistics: ["Average", "Maximum"],
  start_time: "2026-04-05T00:00:00Z",
  end_time: "2026-04-05T01:00:00Z",
  period: 300,
  dimensions: [{Name: "InstanceId", Value: "i-1234567890abcdef0"}],
})

// Lambda invocation count
var result = app.integrations.aws.get_cloudwatch_metrics({
  namespace: "AWS/Lambda",
  metric_name: "Invocations",
  statistics: ["Sum"],
  start_time: "2026-04-04T00:00:00Z",
  end_time: "2026-04-05T00:00:00Z",
  period: 3600,
})
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

```js
var result = app.integrations.aws.list_sns_topics({})
for (const topic of (result.topics || [])) {
  console.log(topic.topic_arn)
}
```
---

## get_current_user

Get the current IAM user identity.

### Parameters

None.

### Example

```js
var result = app.integrations.aws.get_current_user({})
console.log("User ARN: " + result.user.arn)
console.log("Account ID: " + result.user.account_id)
console.log("User ID: " + result.user.user_id)
```
---

## Multi-Account Usage

If you have multiple AWS accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.aws.list_s3_buckets({})

// Explicit default (portable across setups)
app.integrations.aws.default.list_s3_buckets({})

// Named accounts
app.integrations.aws.production.list_s3_buckets({})
app.integrations.aws.staging.list_ec2_instances({})
```
All functions are identical across accounts — only the credentials differ.
