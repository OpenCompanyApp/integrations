# Lambda Labs — JavaScript API Reference

## list_instances

List all GPU instances in the Lambda Labs account.

### Parameters

None.

### Example

```js
var result = app.integrations["lambda-labs"].list_instances({})

for (const instance of (result.data)) {
  console.log(instance.name + " (" + instance.status + ") - " + instance.instance_type)
}
```
---

## get_instance

Get details for a specific GPU instance.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The instance ID |

### Example

```js
var result = app.integrations["lambda-labs"].get_instance({ id: "12345" })
var inst = result.data
console.log(inst.name + " - " + inst.ip + " - " + inst.status)
```
---

## launch_instance

Launch a new GPU instance.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | A human-readable name for the instance |
| `region_name` | string | yes | Region to launch in (e.g., `"us-east-1"`, `"us-west-2"`, `"europe-central-1"`) |
| `instance_type` | string | yes | Instance type slug (e.g., `"gpu_1x_a100"`, `"gpu_8x_h100"`) |
| `ssh_key_ids` | array | yes | Array of SSH key IDs to assign |
| `image_id` | string | no | Image ID for the instance OS |
| `quantity` | integer | no | Number of instances to launch (default: 1) |

### Common Region Names

`us-east-1`, `us-west-2`, `europe-central-1`, `asia-south-1`, `me-west-1`

### Common Instance Types

`gpu_1x_a100`, `gpu_2x_a100`, `gpu_4x_a100`, `gpu_8x_a100`, `gpu_1x_h100`, `gpu_4x_h100`, `gpu_8x_h100`, `gpu_1x_a6000`, `gpu_1x_rtx6000`

### Example

```js
var result = app.integrations["lambda-labs"].launch_instance({
  name: "gpu-training-01",
  region_name: "us-east-1",
  instance_type: "gpu_1x_a100",
  ssh_key_ids: [ "ssh_key_id_here" ],
  quantity: 1,
})

console.log("Launched instance: " + result.data[0].id)
```
---

## list_ssh_keys

List all SSH keys registered in the account.

### Parameters

None.

### Example

```js
var result = app.integrations["lambda-labs"].list_ssh_keys({})

for (const key of (result.data)) {
  console.log(key.name + " (ID: " + key.id + ")")
}
```
---

## list_instance_types

List all available GPU instance types and configurations.

### Parameters

None.

### Example

```js
var result = app.integrations["lambda-labs"].list_instance_types({})

for (const itype of (result.data)) {
  console.log(itype.name + " - " + (itype.description || "") + " - $" + itype.price_per_hour + "/hr")
}
```
---

## list_images

List all available machine images (OS templates).

### Parameters

None.

### Example

```js
var result = app.integrations["lambda-labs"].list_images({})

for (const image of (result.data)) {
  console.log(image.id + " - " + image.name)
}
```
---

## get_current_user

Get the current authenticated user information.

### Parameters

None.

### Example

```js
var result = app.integrations["lambda-labs"].get_current_user({})
console.log("User: " + result.data.email + " (ID: " + result.data.id + ")")
```
---

## Multi-Account Usage

If you have multiple Lambda Labs accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations["lambda-labs"].list_instances({})

// Explicit default (portable across setups)
app.integrations["lambda-labs"].default.list_instances({})

// Named accounts
app.integrations["lambda-labs"].production.list_instances({})
app.integrations["lambda-labs"].research.list_instances({})
```
All functions are identical across accounts — only the credentials differ.
