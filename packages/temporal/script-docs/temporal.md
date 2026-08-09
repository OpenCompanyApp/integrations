# Temporal JavaScript API

Generated from the official `temporalio/api` OpenAPI v3 document. The namespace is `app.integrations.temporal`.

This package exposes 224 endpoint-specific tools: 84 read tools and 140 write tools. Configure `url` with the Temporal HTTP API endpoint and `api_token` with a bearer token accepted by that endpoint.

## Usage

```js
var namespaces = app.integrations.temporal.list_namespaces({})

var workflows = app.integrations.temporal.list_workflow_executions({
  namespace: 'default',
  query: 'WorkflowType = "OrderWorkflow"',
})
```
## Request Bodies

Mutation endpoints may accept a `body` table matching Temporal's OpenAPI schema. Path and query arguments use snake_case names and are mapped back to the official parameter names, including dotted path names such as `execution.workflow_id`.

## Example Tools

| `temporal_get_cluster_info` | read | GET `/api/v1/cluster-info` |
| `temporal_list_namespaces` | read | GET `/api/v1/namespaces` |
| `temporal_register_namespace` | write | POST `/api/v1/namespaces` |
| `temporal_describe_namespace` | read | GET `/api/v1/namespaces/{namespace}` |
| `temporal_list_activity_executions` | read | GET `/api/v1/namespaces/{namespace}/activities` |
| `temporal_pause_activity` | write | POST `/api/v1/namespaces/{namespace}/activities-deprecated/pause` |
| `temporal_reset_activity` | write | POST `/api/v1/namespaces/{namespace}/activities-deprecated/reset` |
| `temporal_unpause_activity` | write | POST `/api/v1/namespaces/{namespace}/activities-deprecated/unpause` |
| `temporal_update_activity_options` | write | POST `/api/v1/namespaces/{namespace}/activities-deprecated/update-options` |
| `temporal_describe_activity_execution` | read | GET `/api/v1/namespaces/{namespace}/activities/{activityId}` |
| `temporal_start_activity_execution` | write | POST `/api/v1/namespaces/{namespace}/activities/{activityId}` |
| `temporal_request_cancel_activity_execution` | write | POST `/api/v1/namespaces/{namespace}/activities/{activityId}/cancel` |
| `temporal_respond_activity_task_completed_by_id` | write | POST `/api/v1/namespaces/{namespace}/activities/{activityId}/complete` |
| `temporal_respond_activity_task_failed_by_id` | write | POST `/api/v1/namespaces/{namespace}/activities/{activityId}/fail` |
| `temporal_record_activity_task_heartbeat_by_id` | write | POST `/api/v1/namespaces/{namespace}/activities/{activityId}/heartbeat` |
| `temporal_poll_activity_execution` | read | GET `/api/v1/namespaces/{namespace}/activities/{activityId}/outcome` |
| `temporal_pause_activity_execution` | write | POST `/api/v1/namespaces/{namespace}/activities/{activityId}/pause` |
| `temporal_reset_activity_execution` | write | POST `/api/v1/namespaces/{namespace}/activities/{activityId}/reset` |
| `temporal_respond_activity_task_canceled_by_id` | write | POST `/api/v1/namespaces/{namespace}/activities/{activityId}/resolve-as-canceled` |
| `temporal_terminate_activity_execution` | write | POST `/api/v1/namespaces/{namespace}/activities/{activityId}/terminate` |
| `temporal_unpause_activity_execution` | write | POST `/api/v1/namespaces/{namespace}/activities/{activityId}/unpause` |
| `temporal_update_activity_execution_options` | write | POST `/api/v1/namespaces/{namespace}/activities/{activityId}/update-options` |
| `temporal_respond_activity_task_completed` | write | POST `/api/v1/namespaces/{namespace}/activity-complete` |
| `temporal_count_activity_executions` | read | GET `/api/v1/namespaces/{namespace}/activity-count` |
| `temporal_respond_activity_task_failed` | write | POST `/api/v1/namespaces/{namespace}/activity-fail` |
| `temporal_record_activity_task_heartbeat` | write | POST `/api/v1/namespaces/{namespace}/activity-heartbeat` |
| `temporal_respond_activity_task_canceled` | write | POST `/api/v1/namespaces/{namespace}/activity-resolve-as-canceled` |
| `temporal_list_archived_workflow_executions` | read | GET `/api/v1/namespaces/{namespace}/archived-workflows` |
| `temporal_list_batch_operations` | read | GET `/api/v1/namespaces/{namespace}/batch-operations` |
| `temporal_describe_batch_operation` | read | GET `/api/v1/namespaces/{namespace}/batch-operations/{jobId}` |
| `temporal_start_batch_operation` | write | POST `/api/v1/namespaces/{namespace}/batch-operations/{jobId}` |
| `temporal_stop_batch_operation` | write | POST `/api/v1/namespaces/{namespace}/batch-operations/{jobId}/stop` |
| `temporal_set_current_deployment` | write | POST `/api/v1/namespaces/{namespace}/current-deployment/{deployment.series_name}` |
| `temporal_get_current_deployment` | read | GET `/api/v1/namespaces/{namespace}/current-deployment/{seriesName}` |
| `temporal_list_deployments` | read | GET `/api/v1/namespaces/{namespace}/deployments` |
| `temporal_describe_deployment` | read | GET `/api/v1/namespaces/{namespace}/deployments/{deployment.series_name}/{deployment.build_id}` |
| `temporal_get_deployment_reachability` | read | GET `/api/v1/namespaces/{namespace}/deployments/{deployment.series_name}/{deployment.build_id}/reachability` |
| `temporal_count_nexus_operation_executions` | read | GET `/api/v1/namespaces/{namespace}/nexus-operation-count` |
| `temporal_list_nexus_operation_executions` | read | GET `/api/v1/namespaces/{namespace}/nexus-operations` |
| `temporal_describe_nexus_operation_execution` | read | GET `/api/v1/namespaces/{namespace}/nexus-operations/{operationId}` |


## Notes

- The HTTP API endpoint URL is deployment-specific.
- Authentication uses `Authorization: Bearer <api_token>`.
- Returned data is the parsed JSON response from Temporal.
