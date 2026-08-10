# RunPod — JavaScript API Reference

## list_pods

List all GPU pods in your RunPod account.

### Parameters

None.

### Example

```js
var result = app.integrations.runpod.list_pods({})

for (const pod of (result.pods)) {
  console.log(pod.name + " (ID: " + pod.pod_id + ") — " + pod.status)
}
```
---

## get_pod

Get detailed information about a specific RunPod GPU pod.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pod_id` | string | yes | The RunPod pod ID |

### Example

```js
var pod = app.integrations.runpod.get_pod({
  pod_id: "abc123def456",
})

console.log("Pod: " + pod.name)
console.log("Status: " + pod.status)
console.log("GPU: " + pod.machine.gpuDisplayName)
```
---

## list_templates

List all available RunPod templates.

### Parameters

None.

### Example

```js
var result = app.integrations.runpod.list_templates({})

for (const tmpl of (result.templates)) {
  console.log(tmpl.name + " — " + (tmpl.image || "no image"))
}
```
---

## list_network_volumes

List all network volumes in your RunPod account.

### Parameters

None.

### Example

```js
var result = app.integrations.runpod.list_network_volumes({})

for (const vol of (result.network_volumes)) {
  console.log(vol.name + " (" + vol.size_in_gb + " GB)")
}
```
---

## list_endpoints

List all RunPod endpoints.

### Parameters

None.

### Example

```js
var result = app.integrations.runpod.list_endpoints({})

for (const ep of (result.endpoints)) {
  console.log(ep.name + " — " + (ep.status || "unknown"))
}
```
---

## list_serverless

List all serverless endpoints in your RunPod account.

### Parameters

None.

### Example

```js
var result = app.integrations.runpod.list_serverless({})

for (const sl of (result.serverless)) {
  console.log(sl.name + " — workers: " + (sl.workers_min || 0) + "-" + (sl.workers_max || "?"))
}
```
---

## get_current_user

Get the profile of the currently authenticated RunPod user.

### Parameters

None.

### Example

```js
var user = app.integrations.runpod.get_current_user({})
console.log("Logged in as: " + (user.firstName || user.username || "Unknown"))
```
---

## Multi-Account Usage

If you have multiple RunPod accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.runpod.list_pods({})

// Explicit default (portable across setups)
app.integrations.runpod.default.list_pods({})

// Named accounts
app.integrations.runpod.work.list_pods({})
app.integrations.runpod.personal.get_pod({ pod_id: "abc123" })
```
All functions are identical across accounts — only the credentials differ.
