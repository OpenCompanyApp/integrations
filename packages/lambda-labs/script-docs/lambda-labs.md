# Lambda Labs — Ruby API Reference

## list_instances

List all GPU instances in the Lambda Labs account.

### Parameters

None.

### Example

```ruby
result = app.call("integrations.lambda-labs.list_instances")
result.data.each do |instance|
  puts((instance.name).to_s + " (" + (instance.status).to_s + ") - " + (instance.instance_type).to_s)
end
```
---

## get_instance

Get details for a specific GPU instance.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The instance ID |

### Example

```ruby
result = app.call("integrations.lambda-labs.get_instance", id: "12345")
inst = result.data
puts((inst.name).to_s + " - " + (inst.ip).to_s + " - " + (inst.status).to_s)
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

```ruby
result = app.call("integrations.lambda-labs.launch_instance", name: "gpu-training-01", region_name: "us-east-1", instance_type: "gpu_1x_a100", ssh_key_ids: ["ssh_key_id_here"], quantity: 1)
puts("Launched instance: " + (result.data[0].id).to_s)
```
---

## list_ssh_keys

List all SSH keys registered in the account.

### Parameters

None.

### Example

```ruby
result = app.call("integrations.lambda-labs.list_ssh_keys")
result.data.each do |key|
  puts((key.name).to_s + " (ID: " + (key.id).to_s + ")")
end
```
---

## list_instance_types

List all available GPU instance types and configurations.

### Parameters

None.

### Example

```ruby
result = app.call("integrations.lambda-labs.list_instance_types")
result.data.each do |itype|
  puts((itype.name).to_s + " - " + ((itype.description || "")).to_s + " - $" + (itype.price_per_hour).to_s + "/hr")
end
```
---

## list_images

List all available machine images (OS templates).

### Parameters

None.

### Example

```ruby
result = app.call("integrations.lambda-labs.list_images")
result.data.each do |image|
  puts((image.id).to_s + " - " + (image.name).to_s)
end
```
---

## get_current_user

Get the current authenticated user information.

### Parameters

None.

### Example

```ruby
result = app.call("integrations.lambda-labs.get_current_user")
puts("User: " + (result.data.email).to_s + " (ID: " + (result.data.id).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple Lambda Labs accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.call("integrations.lambda-labs.list_instances")
# Explicit default (portable across setups)
app.call("integrations.lambda-labs.default.list_instances")
# Named accounts
app.call("integrations.lambda-labs.production.list_instances")
app.call("integrations.lambda-labs.research.list_instances")
```
All functions are identical across accounts — only the credentials differ.
