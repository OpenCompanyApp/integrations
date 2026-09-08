# RunPod — Ruby API Reference

## list_pods

List all GPU pods in your RunPod account.

### Parameters

None.

### Example

```ruby
result = app.integrations.runpod.list()
result.pods.each do |pod|
  puts((pod.name).to_s + " (ID: " + (pod.pod_id).to_s + ") — " + (pod.status).to_s)
end
```
---

## get_pod

Get detailed information about a specific RunPod GPU pod.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pod_id` | string | yes | The RunPod pod ID |

### Example

```ruby
pod = app.integrations.runpod.get(pod_id: "abc123def456")
puts("Pod: " + (pod.name).to_s)
puts("Status: " + (pod.status).to_s)
puts("GPU: " + (pod.machine.gpuDisplayName).to_s)
```
---

## list_templates

List all available RunPod templates.

### Parameters

None.

### Example

```ruby
result = app.integrations.runpod.list_templates()
result.templates.each do |tmpl|
  puts((tmpl.name).to_s + " — " + ((tmpl.image || "no image")).to_s)
end
```
---

## list_network_volumes

List all network volumes in your RunPod account.

### Parameters

None.

### Example

```ruby
result = app.integrations.runpod.list_network_volumes()
result.network_volumes.each do |vol|
  puts((vol.name).to_s + " (" + (vol.size_in_gb).to_s + " GB)")
end
```
---

## list_endpoints

List all RunPod endpoints.

### Parameters

None.

### Example

```ruby
result = app.integrations.runpod.list_endpoints()
result.endpoints.each do |ep|
  puts((ep.name).to_s + " — " + ((ep.status || "unknown")).to_s)
end
```
---

## list_serverless

List all serverless endpoints in your RunPod account.

### Parameters

None.

### Example

```ruby
result = app.integrations.runpod.list_serverless()
result.serverless.each do |sl|
  puts((sl.name).to_s + " — workers: " + ((sl.workers_min || 0)).to_s + "-" + ((sl.workers_max || "?")).to_s)
end
```
---

## get_current_user

Get the profile of the currently authenticated RunPod user.

### Parameters

None.

### Example

```ruby
user = app.integrations.runpod.get_current_user()
puts("Logged in as: " + (((user.firstName || user.username) || "Unknown")).to_s)
```
---

## Multi-Account Usage

If you have multiple RunPod accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.runpod.list()
# Explicit default (portable across setups)
app.integrations.runpod.default.list()
# Named accounts
app.integrations.runpod.work.list()
app.integrations.runpod.personal.get(pod_id: "abc123")
```
All functions are identical across accounts — only the credentials differ.
