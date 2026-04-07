# Lambda Labs — Lua API Reference

## list_instances

List all GPU instances in the Lambda Labs account.

### Parameters

None.

### Example

```lua
local result = app.integrations["lambda-labs"].list_instances({})

for _, instance in ipairs(result.data) do
  print(instance.name .. " (" .. instance.status .. ") - " .. instance.instance_type)
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

```lua
local result = app.integrations["lambda-labs"].get_instance({ id = "12345" })
local inst = result.data
print(inst.name .. " - " .. inst.ip .. " - " .. inst.status)
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

```lua
local result = app.integrations["lambda-labs"].launch_instance({
  name = "gpu-training-01",
  region_name = "us-east-1",
  instance_type = "gpu_1x_a100",
  ssh_key_ids = { "ssh_key_id_here" },
  quantity = 1
})

print("Launched instance: " .. result.data[1].id)
```

---

## list_ssh_keys

List all SSH keys registered in the account.

### Parameters

None.

### Example

```lua
local result = app.integrations["lambda-labs"].list_ssh_keys({})

for _, key in ipairs(result.data) do
  print(key.name .. " (ID: " .. key.id .. ")")
end
```

---

## list_instance_types

List all available GPU instance types and configurations.

### Parameters

None.

### Example

```lua
local result = app.integrations["lambda-labs"].list_instance_types({})

for _, itype in ipairs(result.data) do
  print(itype.name .. " - " .. (itype.description or "") .. " - $" .. itype.price_per_hour .. "/hr")
end
```

---

## list_images

List all available machine images (OS templates).

### Parameters

None.

### Example

```lua
local result = app.integrations["lambda-labs"].list_images({})

for _, image in ipairs(result.data) do
  print(image.id .. " - " .. image.name)
end
```

---

## get_current_user

Get the current authenticated user information.

### Parameters

None.

### Example

```lua
local result = app.integrations["lambda-labs"].get_current_user({})
print("User: " .. result.data.email .. " (ID: " .. result.data.id .. ")")
```

---

## Multi-Account Usage

If you have multiple Lambda Labs accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["lambda-labs"].list_instances({})

-- Explicit default (portable across setups)
app.integrations["lambda-labs"].default.list_instances({})

-- Named accounts
app.integrations["lambda-labs"].production.list_instances({})
app.integrations["lambda-labs"].research.list_instances({})
```

All functions are identical across accounts — only the credentials differ.
